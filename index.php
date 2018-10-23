<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 22/10/2018
 * Time: 11:28
 */
//Puto si lees esto
//Aqui implementaré la api con control de sessiones y gestion de roles
//Establecer zona horaria
date_default_timezone_set('America/Lima');
//LLamada a archivo gestor de base de da+tos
require 'core/Database.php';
//Levantamiento del Log para registro de errores
require "app/models/Log.php";
//Levantamiento de registro de roles y permisos
require_once "app/models/Menu.php";
$errores = new Log();
$vistas = new Menu();

//echo var_dump($permisos);

//Inicio clase para la encriptacion de contenido
require 'app/models/Crypt.php';

// Errores de PHP a Try/Catch
// Falta mejorar esta vaina porque puto el que lo lea
function exception_error_handler($severidad, $mensaje, $fichero, $linea) {
    $cadena =  '[LEVEL]: ' . $severidad . ' IN ' . $fichero . ': ' . $linea . '[MESSAGGE]' . $mensaje . "\n";
    $guardar = new Log();
    $guardar->insert($cadena, "Excepcion No Manejada");
    //echo $cadena;
}
//Para manejo de caracteres
header("Content-Type: text/html;charset=utf-8");
//Especificar el manejo de errores personalizados
set_error_handler("exception_error_handler");
session_start();

// path
// Definicion Variables Globales
define('_SERVER_', 'http://localhost/bpsoft/');
define('_STYLES_', 'styles/');
define('_LOGIN_STYLES_', 'styles/login/');
define('_VIEW_PATH_', 'app/view/');
//Estilos Index
define('_VIEW_PATH_INDEX_', 'styles/index/');
define('_TITLE_', 'BP Soft');
define('_ICON_', 'styles/pool.png');


//Inicio de codigo de la api
//Verificar existencia de los archivos
if(isset($_GET['c'])){
    $controlador = $_GET['c'];
} else {
    if(isset($_SESSION['role']) || isset($_COOKIE['role'])){
        $controlador = $_GET['c'] ?? "Index";
    } else {
        $controlador = $_GET['c'] ?? "Login";
    }
}
$controlador = trim(ucfirst($controlador));
$accion = $_GET['a'] ?? "index";
$function_action = $controlador . "|" . $accion;
$archivo = 'app/controllers/' . $controlador . 'Controller.php';
if(file_exists($archivo)){
    //Acciones si el archivo existe
    //Verificar si existe inicio de sesion
    $autorizado = false;

    if(isset($_SESSION['role']) || isset($_COOKIE['role'])){
        $crypt = new Crypt();
        $role = $_COOKIE['role'] ?? $_SESSION['role'];
        $rol = $crypt->decrypt($_SESSION['role'], 'zxcvbnm');
        $view = $controlador . '/' . $accion;
        $autorizado = $vistas->readViewrole($rol, $view);

    } else {
        $view = $controlador . '/' . $accion;
        $autorizado = $vistas->readViewrole(1, $view);
    }
    //$autorizado =  true;
    if($autorizado){
        try{
            require $archivo;
            $clase = sprintf('%sController', $_GET['c'] ?? $controlador);
            $accion = $_GET['a'] ?? "index";
            $clase = trim(ucfirst($clase));
            $accion = trim(strtolower($accion));
            $controller = new $clase;
            $controller->$accion();
        } catch (\Throwable $e){
            require 'app/controllers/ErrorController.php';
            $clase = sprintf('%sController', 'Error');
            $clase = trim(ucfirst($clase));
            $accion = 'error';
            $controller = new $clase;
            $controller->$accion();
            //echo $e->getMessage();
            //echo 'Solicitud erronea. Contacte con el administrador';
            $errores->insert($e->getMessage(), $function_action);
        }
    } else {
        //LLEGA AQUI SI SE TRATA DE ACCEDER A ACCION O FUNCION SIN PERMISOS
        require 'app/controllers/LoginController.php';
        $clase = sprintf('%sController', 'Login');
        $clase = trim(ucfirst($clase));
        $accion = 'index';
        $controller = new $clase;
        $controller->$accion();
        $errores->insert("SIN PERMISOS SUFICIENTES", $function_action);
        //echo 'Estoy llegando aqui :/';
    }
} else {
    require 'app/controllers/ErrorController.php';
    $clase = sprintf('%sController', 'Error');
    $clase = trim(ucfirst($clase));
    $accion = 'error';
    $controller = new $clase;
    $controller->$accion();
    //Acciones si el archivo no existe
    //Automaticamente, notificar error
    $errores->insert("ACCESO A CONTROLADOR NO EXISTENTE", $function_action);
    //echo 2;
}
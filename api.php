<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 21/09/2018
 * Time: 0:34
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
require_once "app/models/Role.php";
$errores = new Log();
$controladores_acciones = new Role();

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


// Definicion Variables Globales
require 'core/global.php';

//Inicio de codigo de la api
//Verificar existencia de los archivos
$controlador = $_GET['c'] ?? "none";
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
        $rol = $crypt->decrypt($role, _PASS_);
        $permisos = $controladores_acciones->readPermitscontroller($rol, $controlador);
        foreach ($permisos as $permiso){
            if($permiso->permit_controller == $controlador && $permiso->permit_action == $accion && $permiso->permit_status == 1){
                $autorizado = true;
                //echo "La funcion funciona xd";
            }
        }
        //Verificar permisos
        //Inicio
        //(En esta parte se hará consultas sql para verificar los permisos del usuarios. Caso que no se encuentre su permiso, este será denegado
        /*
         * Paso 1: Obtener Rol Usuario
         * Paso 2: Obtener lista de accesos por Rol
         * Paso 3: Validar si puede realizar la accion invocada
         * */
        //Fin
    } else {
        $permisos = $controladores_acciones->readPermits(2);
        foreach ($permisos as $permiso){
            if($permiso->permit_controller == $controlador && $permiso->permit_action == $accion && $permiso->permit_status == 1){
                $autorizado = true;
                //echo "La funcion funciona xd";
            }
        }
        //Verificar metodos de acceso sin restricciones
        //Inicio
        //(En esta parte se hará consultas sql para verificar los permisos libres disponibles, sino sera denegado)
        /*
         * Paso 1: Obtener Rol Usuario
         * Paso 2: Obtener lista de accesos por Rol
         * Paso 3: Validar si puede realizar la accion invocada
         * */
        //Fin
    }
    //$autorizado =  true;
    if($autorizado){
        try{
            require $archivo;
            $clase = sprintf('%sController', $_GET['c'] ?? 'Admin');
            $clase = trim(ucfirst($clase));
            $accion = trim(strtolower($accion));
            $controller = new $clase;
            $controller->$accion();
        } catch (\Throwable $e){
            /*require 'app/controllers/ErrorController.php';
            $clase = sprintf('%sController', 'Error');
            $accion = 'error';
            $clase = trim(ucfirst($clase));
            $accion = trim(strtolower($accion));
            $controller = new $clase;
            $controller->$accion();*/
            echo $e->getMessage();
            echo 'Solicitud erronea. Contacte con el administrador';
            $errores->insert($e->getMessage(), $function_action);
        }
    } else {
        //LLEGA AQUI SI SE TRATA DE ACCEDER A ACCION O FUNCION SIN PERMISOS
        $errores->insert("SIN PERMISOS SUFICIENTES", $function_action);
        echo 2;
    }
} else {
    //Acciones si el archivo no existe
    //Automaticamente, notificar error
    $errores->insert("ACCESO A CONTROLADOR NO EXISTENTE", $function_action);
    echo 2;
}
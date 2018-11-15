<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:48
 */

//Llamada a modelos necesarios
require 'app/models/Person.php';
//gg
//use Exception;
class PersonController {
    private $person;
    private  $log;
    private $crypt;
    private $menu;
    public function __construct(){
        $this->person = new Person();
        $this->log = new Log();
        $this->crypt = new Crypt();
        $this->menu = new Menu();
    }
    //Vistas
    public function list(){
        try{
            $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
            $list = $this->person->list();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'person/readall.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'PersonController|list');
        }
    }

    public function addPerson(){
        try{
            $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'person/addperson.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'PersonController|list');
        }
    }

    public function editPerson(){
        try{
            $id_person = $_GET['id'];
            $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
            $list = $this->person->listperson($id_person);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'person/editperson.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'PersonController|list');
        }
    }

    //Funciones
    public function save() {
        try{
            $model = new Person();
            $model->person_name = $_POST['person_name'];
            $model->person_surname = $_POST['person_surname'];
            $model->person_dni = $_POST['person_dni'];
            $model->person_address = $_POST['person_address'];
            $model->person_cellphone = $_POST['person_cellphone'];
            $model->person_genre = $_POST['person_genre'];
            if(isset($_POST['id_person'])){
                $model->id_person = $_POST['id_person'];
            }
            $save = $this->person->save($model);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'PersonController|save');
            $save = 2;
        }
        echo $save;
    }

    public function deletePerson(){
        try{
            $id_person = $_POST['id_person'];
            $save = $this->person->deletePerson($id_person);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'PersonController|deletePerson');
            $save = 2;
        }

        echo $save;
    }

}

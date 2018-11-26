<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 25/11/2018
 * Time: 14:23
 */

require 'app/models/Location.php';
class LocationController{
    private $crypt;
    private $menu;
    private $log;
    private $location;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->log = new Log();
        $this->location = new Location();

    }

    //Vistas
    public function all(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $locations = $this->location->list();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'location/all.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function add(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'location/add.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function edit(){
        $id = $_GET['id'];
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $location= $this->location->listLocation($id);
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'location/edit.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Funciones
    public function save(){
        try{
            $model = new Location();
            if(isset($_POST['id_location'])){
                $model->id_location = $_POST['id_location'];
                $model->location_name= $_POST['location_name'];
                $result = $this->location->save($model);
            } else {
                $model->location_name= $_POST['location_name'];
                $result = $this->location->save($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'LocationController|save');
            $result = 2;
        }

        echo $result;
    }

    //Borrar
    public function delete(){
        try{
            $id = $_POST['id'];
            $result = $this->location->delete($id);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'LocationController|delete');
            $result = 2;
        }

        echo $result;
    }

}
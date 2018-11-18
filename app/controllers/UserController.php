<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:49
 */

//Llamada a modelos necesarios
require 'app/models/User.php';
require 'app/models/Person.php';
//gg
//use Exception;
class UserController {
    private $crypt;
    private $menu;
    private $user;
    private $log;
    private $person;
    public function __construct(){
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->user = new User();
        $this->log = new Log();
        $this->person = new Person();
    }
    //Vistas
    public function seeAll(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $users = $this->user->readAll();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'user/seeall.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function add(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $roles = $this->user->readAllrolenotfree();
        $person = $this->person->listwithout();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'user/add.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function edit(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $useractive = $this->user->selectuser($id);

        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $roles = $this->user->readAllrolenotfree();
        $person = $this->person->listwithout();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'user/edit.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function modifyPassword(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $useractive = $this->user->selectuser($id);
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'user/editp.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Funciones
    public function save() {
        try{
            if(isset($_POST['password'])){
                $model = new User();
                if(isset($_POST['id_user'])){
                    $model->id_user = $_POST['id_user'];
                }
                $model->user_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT);
                $save = $this->user->changepassword($model);
            } else {
                $model = new User();
                if(isset($_POST['id_user'])){
                    $model->id_user = $_POST['id_user'];
                }
                $model->user_nickname = $_POST['user_nickname'];
                $model->user_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT);
                $model->user_image = "media/user/1/user.jpg";
                $model->user_status = 1;
                $model->id_person = $_POST['id_person'];
                $model->id_role = $_POST['id_role'];
                $save = $this->user->save($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'UserController|save');
            $save = 2;
        }
        echo $save;
    }

    public function deleteUser() {
        try{
            $user = $_POST['id'];
            $status = $_POST['status'];
            $save = $this->user->changestatus($user, $status);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'UserController|deleteUser');
            $save = 2;
        }
        echo $save;
    }


    /*public function readAll(){
        try{
            $list = $this->user->readAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'UserController|readAll');
            $list = 2;
        }
        echo $list;
    }*/

    /*public function insertRoleuser(){
        try{
            $model = new User();
            $model->id_role = $_POST['id_role'];
            $model->id_user = $_POST['id_user'];
            $save = $this->user->insertRoleuser($model);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'UserController|insertRoleuser');
            $save = 2;
        }
        echo $save;
    }*/
}
<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:49
 */

require 'core/Database.php';
//Llamada a modelos necesarios
require 'app/models/User.php';
//gg
//use Exception;
class UserController {
    private $user;
    private $log;
    public function __construct(){
        $this->user = new User();
        $this->log = new Log();
    }

    public function save() {
        try{
            $model = new User();
            $model->user_nickname = $_POST['user_nickname'];
            $model->user_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT);
            $model->user_image = $_POST['user_image'];
            $model->user_email = $_POST['user_email'];
            $model->user_last_login = $_POST['user_last_login'];
            $model->user_created_at= $_POST['user_created_at'];
            $model->user_created_at= $_POST['user_modified_at'];
            $model->user_status = 1;
            $save = $this->user->save($model);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'UserController|save');
            $save = 2;
        }
        echo $save;
    }
    public function readAll(){
        try{
            $list = $this->user->readAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'UserController|readAll');
            $list = 2;
        }
        echo $list;
    }

    public function insertRoleuser(){
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
    }
}
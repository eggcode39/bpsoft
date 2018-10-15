<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:48
 */

//gg
//use Exception;
class RoleController {
    private $role;
    private $log;
    public function __construct(){
        $this->role = new Role();
        $this->log = new Log();
    }

    public function save() {
        try{
            $model = new Role();
            if(isset($_POST['id_role'])){
                $model->role_id = $_POST['id_role'];
            }
            $model->role_name = $_POST['role_name'];
            $model->role_description = $_POST['role_description'];
            $save = $this->role->save($model);
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, "RoleController|save");
            $save = 2;
        }
        echo $save;
    }

    public function insertPermits(){
        try{
            $model = new Role();
            $model->id_role = $_POST['id_role'];
            $model->permits = $_POST['permits'];
            $save = $this->role->insertPermits($model);
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, 'RoleController|insertPermits');
            $save = 2;
        }
        echo $save;
    }

    public function deleteRole(){
        try{
            $id = $_POST['id_role'];
            $save = $this->role->deleteRole($id);
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error,'RoleController|deleteRole');
            $save = 2;
        }
        echo $save;
    }

    public function deletePermit(){
        try{
            $model = new Role();
            $model->id_role = $_POST['id_role'];
            $model->id_permit = $_POST['id_permit'];
            $save = $this->role->deletePermit($model);
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error,'RoleController|deletePermit');
            $save = 2;
        }
        echo $save;
    }

}
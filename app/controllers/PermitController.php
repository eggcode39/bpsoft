<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:18
 */

//Llamada a modelos necesarios
require 'app/models/Permit.php';
//gg
//use Exception;
class PermitController {
    private $permit;
    private $log;
    public function __construct(){
        $this->permit = new Permit();
        $this->log = new Log();
    }

    public function save() {

        try{
            $model = new Permit();
            if(isset($_POST['id_permit'])){
                $model->permit_id = $_POST['id_permit'];
            }
            $model->permit_controller = $_POST['permit_controller'];
            $model->permit_action = $_POST['permit_action'];
            $model->permit_status = $_POST['permit_status'];
            $save = $this->permit->save($model);
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, 'PermitController|save');
            $save = 2;
        }
        echo $save;
    }

    public function readAll() {
        try{
            $save = $this->permit->readAll();
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, 'PermitController|save');
            $save = 2;
        }
        //echo $save;
        echo json_encode($save);
    }

    public function delete(){
        try{
            $id = $_POST['id_permit'];
            $save = $this->permit->delete($id);
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, 'PermitController|delete');
            $save = 2;
        }
        echo $save;
    }

    public function changeStatus(){
        try {
            $id = $_POST['id_permit'];
            $status = $_POST['permit_status'];
            $save = $this->permit->changeStatus($id, $status);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'PermitController|changeStatus');
            $save = 2;
        }

        echo $save;
    }
}

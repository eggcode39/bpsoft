<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:18
 */

//use Exception;
class Permit{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function save($model){
        try {
            if(empty($model->id_permit)){
                $sql = 'insert into permit(
                    permit_controller,
                    permit_action,
                    permit_status 
                    ) select ?,?,? FROM dual
                    WHERE NOT EXISTS (SELECT permit_action FROM permit WHERE permit_controller = ? and permit_action = ?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->permit_controller,
                    $model->permit_action,
                    $model->permit_status,
                    $model->permit_controller,
                    $model->permit_action
                ]);
                $result = 1;
            } else {
                $sql = "
                    update permit
                    set
                    permit_controller = ?,
                    permit_action = ?,
                    permit_status = ?
                    where id_permit = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->permit_controller,
                    $model->permit_action,
                    $model->permit_status,
                    $model->id_permit
                ]);
                $result = 1;
            }

        } catch (Exception $e){
            $error = $e->getMessage();
            $location = "Permit|save";
            $this->log->insert($error,$location);
            $result = 2;
        }
        return $result;
    }

    public function delete($id){
        try{
            $sql = "delete from permit where id_permit = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $error = $e->getMessage();
            $location = "Permit|delete";
            $this->log->insert($error,$location);
            $result = 2;
        }
        return $result;
    }

    public function changeStatus($id, $status){
        try{
            if($status == 1){
                $status = 0;
            } else {
                $status = 1;
            }
            $sql = "update permit set permit_status = ? where id_permit = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$status, $id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Permit|changeStatus');
            $result = 2;
        }
        return $result;
    }

    public function readAll(){
        try{

            $sql = "select * from permit";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Permit|readAll');
            $result = 2;
        }
        return $result;
    }
}
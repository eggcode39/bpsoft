<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 17/10/2018
 * Time: 1:13
 */

use Exception;
class User{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function save($model){
        $result = 2;
        try {
            if(empty($model->id_user)){
                $sql = 'call s_i_insert_user(?,?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->bindParam(1,$model->id_person,PDO::PARAM_INT);
                $stm->bindParam(2,$model->user_nickname,PDO::PARAM_STR);
                $stm->bindParam(3,$model->user_password,PDO::PARAM_STR);
                $stm->bindParam(4,$model->user_image,PDO::PARAM_STR);
                $stm->bindParam(5,$model->user_email,PDO::PARAM_STR);
                $stm->bindParam(6,$model->user_last_login,PDO::PARAM_STR);
                $stm->bindParam(7,$model->user_created_at,PDO::PARAM_STR);
                $stm->bindParam(8,$model->user_modified_at,PDO::PARAM_STR);
                $stm->bindParam(9,$model->user_status,PDO::PARAM_STR);
                $stm->execute();
                $result = 1;
            } else {
                $sql = "call s_u_update_user(?,?,?,?,?,?,?,?,?,?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindParam(1,$model->id_person,PDO::PARAM_INT);
                $stm->bindParam(2,$model->user_nickname,PDO::PARAM_STR);
                $stm->bindParam(3,$model->user_password,PDO::PARAM_STR);
                $stm->bindParam(4,$model->user_image,PDO::PARAM_STR);
                $stm->bindParam(5,$model->user_email,PDO::PARAM_STR);
                $stm->bindParam(6,$model->user_last_login,PDO::PARAM_STR);
                $stm->bindParam(7,$model->user_created_at,PDO::PARAM_STR);
                $stm->bindParam(8,$model->user_modified_at,PDO::PARAM_STR);
                $stm->bindParam(9,$model->user_status,PDO::PARAM_STR);
                $stm->bindParam(10,$model->id_user,PDO::PARAM_INT);
                $stm->execute();
                $result = 1;
            }
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(),'User|save');
            $result = 2;
        }
        return $result;
    }
    public function readAll(){
        $result = [];
        try {
            $sql = 'select * from user u inner join person p on u.id_person = p.id_person';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(),'User|readAll');
            $result = 2;
        }
        return $result;
    }

    /*public function insertRoleuser($model){
        try{
            $sql = "insert into roleuser (id_role, id_user) values (?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_role,
                $model->id_user
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'User|insertRoleuser');
            $result = 2;
        }

        return $result;
    }*/


}
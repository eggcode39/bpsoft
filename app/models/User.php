<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 17/10/2018
 * Time: 1:13
 */

//use Exception;
class User{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function readAllrolenotfree(){
        try{
            $sql = 'select * from role where id_role <> 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), "User|readAllrolenotfree");
            $result = 2;
        }
        return $result;
    }

    public function selectuser($id){
        try{
            $sql = 'select * from user u inner join person p on u.id_person = p.id_person where u.id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), "User|selectuser");
            $result = 2;
        }
        return $result;
    }

    public function save($model){
        try {
            if(empty($model->id_user)){
                $sql = 'insert into user (id_person, id_role, user_nickname, user_password, user_image, user_status) values(?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_person,
                    $model->id_role,
                    $model->user_nickname,
                    $model->user_password,
                    $model->user_image,
                    $model->user_status
                ]);
                $result = 1;
            } else {
                $sql = 'update user set
                id_person = ?,
                id_role = ?,
                user_nickname = ?,
                user_image = ?,
                user_status = ?
                where id_user = ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_person,
                    $model->id_role,
                    $model->user_nickname,
                    $model->user_image,
                    $model->user_status,
                    $model->id_user
                ]);
                $result = 1;
            }
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(),'User|save');
            $result = 2;
        }
        return $result;
    }

    public function changepassword($model){
        try {
            $sql = 'update user set
                user_password = ?
                where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->user_password,
                $model->id_user
            ]);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(),'User|changepassword');
            $result = 2;
        }
        return $result;
    }
    public function readAll(){
        try {
            $sql = 'select * from user u inner join person p on u.id_person = p.id_person inner join role r on u.id_role = r.id_role';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(),'User|readAll');
            $result = 2;
        }
        return $result;
    }

    public function changestatus($id_user, $status){
        try {
            $sql = 'update user set user_status = ? where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $status,
                $id_user
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(),'User|changestatus');
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
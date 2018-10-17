<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 17/10/2018
 * Time: 1:13
 */

class Person{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function save($model){
        try {
            if(empty($model->id_person)){
                $sql = 'call s_i_insert_person(?,?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->bindParam(1,$model->id_district,PDO::PARAM_INT);
                $stm->bindParam(2,$model->person_name,PDO::PARAM_STR);
                $stm->bindParam(3,$model->person_surname,PDO::PARAM_STR);
                $stm->bindParam(4,$model->person_address,PDO::PARAM_STR);
                $stm->bindParam(5,$model->person_coord_x,PDO::PARAM_STR);
                $stm->bindParam(6,$model->person_coord_y,PDO::PARAM_STR);
                $stm->bindParam(7,$model->person_cellphone,PDO::PARAM_STR);
                $stm->bindParam(8,$model->person_genre,PDO::PARAM_STR);
                $stm->bindParam(9,$model->person_birth,PDO::PARAM_STR);
                $stm->execute();
                $result = 1;
            } else {
                $sql = "call s_u_update_person(?,?,?,?,?,?,?,?,?,?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindParam(1,$model->id_district,PDO::PARAM_INT);
                $stm->bindParam(2,$model->person_name,PDO::PARAM_STR);
                $stm->bindParam(3,$model->person_surname,PDO::PARAM_STR);
                $stm->bindParam(4,$model->person_address,PDO::PARAM_STR);
                $stm->bindParam(5,$model->person_coord_x,PDO::PARAM_STR);
                $stm->bindParam(6,$model->person_coord_y,PDO::PARAM_STR);
                $stm->bindParam(7,$model->person_cellphone,PDO::PARAM_STR);
                $stm->bindParam(8,$model->person_genre,PDO::PARAM_STR);
                $stm->bindParam(9,$model->person_birth,PDO::PARAM_STR);
                $stm->bindParam(10,$model->id_person,PDO::PARAM_INT);
                $stm->execute();
                $result = 1;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Person|save');
            $result = 2;
        }
        return $result;
    }
    public function readAll(){
        $result = [];
        try {
            $sql = 'call s_s_readAll_person()';
            $stm = $this->pdo->prepare($sql);
            $result = $stm->execute();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Person|readAll');
            $result = 2;
        }
        return $result;
    }
}
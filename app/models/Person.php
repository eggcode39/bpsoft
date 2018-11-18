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
                $sql = 'insert into person (person_name, person_surname, person_dni, person_address, person_cellphone, person_genre) values (?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->person_name,
                    $model->person_surname,
                    $model->person_dni,
                    $model->person_address,
                    $model->person_cellphone,
                    $model->person_genre
                ]);
                $result = 1;
            } else {
                $sql = 'update person set person_name = ?, person_surname = ?, person_dni = ?, person_address = ?, person_cellphone = ?, person_genre = ? where id_person = ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->person_name,
                    $model->person_surname,
                    $model->person_dni,
                    $model->person_address,
                    $model->person_cellphone,
                    $model->person_genre,
                    $model->id_person
                ]);
                $result = 1;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Person|save');
            $result = 2;
        }
        return $result;
    }
    public function list(){
        try {
            $sql = 'select * from person where id_person <> 2';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Person|list');
            $result = 2;
        }
        return $result;
    }

    public function listwithout(){
        try {
            $sql = 'select * from person p where p.id_person <> 2 and not exists (select null from user u where u.id_person = p.id_person)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Person|listwithout');
            $result = 2;
        }
        return $result;
    }

    public function listperson($id_person){
        try {
            $sql = 'select * from person where id_person = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_person]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Person|list');
            $result = 2;
        }
        return $result;
    }

    public function deletePerson($id_person){
        try {
            $sql = 'delete from person where id_person = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_person
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Person|deletePerson');
            $result = 2;
        }
        return $result;
    }
}
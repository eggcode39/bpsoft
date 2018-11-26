<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 25/11/2018
 * Time: 14:23
 */

class Location{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }

    //Listar Locaciones Registradas
    public function list(){
        try{
            $sql = "Select * from location order by location_name asc";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Location|list');
            $result = 2;
        }

        return $result;
    }

    //Agregar o Editar Producto
    public function save($model){
        try {
            if(empty($model->id_location)){
                $sql = 'insert into location (location_name, location_status) values(?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->location_name,
                    0
                ]);

            } else {
                $sql = "update location
                set location_name = ?
                where id_location = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->location_name,
                    $model->id_location
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Location|save');
            $result = 2;
        }

        return $result;
    }

    //Listar Producto Registrado
    public function listLocation($id){
        try{
            $sql = "Select * from location where id_location = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Location|listLocation');
            $result = 2;
        }

        return $result;
    }

    //Eliminar Producto Registrado
    public function delete($id){
        try{
            $sql = "delete from location where id_location = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Location|delete');
            $result = 2;
        }

        return $result;
    }

}
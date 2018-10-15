<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:48
 */

//LLamada a archivo gestor de base de datos
require 'core/Database.php';
//Llamada a modelos necesarios
require 'app/models/Person.php';
//gg
//use Exception;
class PersonController {
    private $person;
    private  $log;
    public function __construct(){
        $this->person = new Person();
        $this->log = new Log();
    }

    public function save() {
        try{
            $model = new Person();
            $model->id_district = $_POST['id_district'];
            $model->person_name = $_POST['person_name'];
            $model->person_surname = $_POST['person_surname'];
            $model->person_address = $_POST['person_address'];
            $model->person_coord_x = $_POST['person_coord_x'];
            $model->person_coord_y = $_POST['person_coord_y'];
            $model->person_cellphone = $_POST['person_cellphone'];
            $model->person_genre = $_POST['person_genre'];
            $model->person_birth = $_POST['person_birth'];
            $model->id_person = $_POST['id_person'];
            $save = $this->person->save($model);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'PersonController|save');
            $save = 2;
        }
        echo $save;
    }
    public function readAll(){
        try{
            $list = $this->person->readAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'PersonController|save');
            $list = 2;
        }
        echo $list;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 25/11/2018
 * Time: 11:13
 */

class Admin{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }

    //Contar Usuarios Registrados
    public function count_users(){
        try{
            $sql = 'select count(id_user) total from user';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $r = $stm->fetch();
            $return = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Admin|count_user');
            $return = 2;
        }
        return $return;
    }
}
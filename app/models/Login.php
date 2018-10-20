<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 06/10/2018
 * Time: 0:17
 */

class Login{
    private $pdo;
    private $log;
    public function __construct(){
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }

    public function singIn($model){
        try{
            $sql = 'call s_s_login_user(?)';
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1,$model->user_nickname,PDO::PARAM_STR);
            //$stm->bindParam(2,$model->user_password,PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Login|singIn');
            $result = 2;
        }
        if($result == 2){
            return $result;
        } else if((empty($result))) {
            return 3;
        } else {
            return $result;
        }

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 20/11/2018
 * Time: 19:06
 */

class Active{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function getTurnactive(){
        try{
            $sql = 'select id_turn from turn where turn_active = 1 limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch();
            $return = $result->id_turn;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|getTurnactive');
            $return = 0;
        }
        return $return;
    }
}
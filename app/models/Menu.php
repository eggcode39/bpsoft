<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 22/10/2018
 * Time: 11:29
 */


class Menu{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function listMenu($id_role){
        $result = [];
        try{
            $sql = "Select m.menu_name, o.option_name, o.option_url from role r inner join rolemenu rl on r.id_role = rl.id_role inner join menu m on m.id_menu = rl.id_menu inner join optionmenu o on o.id_menu = m.id_menu where rl.id_role = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_role]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Role|readPermits');
            $result = 2;
        }
        return $result;

    }

    public function readViewrole($id_role, $view){
        $result = [];
        $validate = false;
        try{
            $sql = "Select m.menu_name, o.option_name, o.option_url from role r inner join rolemenu rl on r.id_role = rl.id_role inner join menu m on m.id_menu = rl.id_menu inner join optionmenu o on o.id_menu = m.id_menu where o.option_url = ? and rl.id_role = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$view, $id_role]);
            $result = $stm->fetchAll();
            if(count($result) > 0){
                $validate = true;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Role|readPermits');
            $validate = false;
        }
        return $validate;

    }

}
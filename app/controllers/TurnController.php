<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 19/11/2018
 * Time: 10:21
 */

require 'app/models/Turn.php';
class TurnController{
    private $log;
    private $turn;
    private $menu;
    private $crypt;

    public function __construct()
    {
        $this->log = new Log();
        $this->turn = new Turn();
        $this->menu = new Menu();
        $this->crypt = new Crypt();
    }

    //Vistas
    public function seeAll(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $turns = $this->turn->listall();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'turn/seeall.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function add(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'turn/add.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Funciones
    public function save(){
        try{
            $model = new Turn();
            $model->turn_datestart = $_POST['turn_datestart'];
            $model->turn_datefinish = $_POST['turn_datefinish'];
            $result = $this->turn->save($model);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|save');
            $result = 2;
        }
        echo $result;
    }

    public function delete(){
        try{
            $id_turn = $_POST['id'];
            $result = $this->turn->delete($id_turn);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|delete');
            $result = 2;
        }
        echo $result;
    }

    public function change(){
        try{
            $id_turn = $_POST['id'];
            $result = $this->turn->change($id_turn);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|change');
            $result = 2;
        }
        echo $result;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 22/11/2018
 * Time: 18:07
 */

require 'app/models/Report.php';
require 'app/models/Turn.php';
require 'app/models/Active.php';
class ReportController{
    private $log;
    private $menu;
    private $crypt;
    private $turn;
    private $report;
    private $active;

    public function __construct()
    {
        $this->log = new Log();
        $this->menu = new Menu();
        $this->crypt = new Crypt();
        $this->turn = new Turn();
        $this->report =  new Report();
        $this->active = new Active();
    }

    public function day(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $turn = $this->active->getTurnactiveall();
        $products = $this->turn->listP();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'report/day.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function all(){
        if(isset($_SESSION['turno'])){
            $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
        } else {
            $turn = $this->active->getTurnactiveall();
        }
        $info_turns = $this->active->getAllTurns();
        $products = $this->turn->listP();
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'report/all.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function set_turn(){
        $_SESSION['turno'] = $_POST['id'];
        echo 1;
    }

}
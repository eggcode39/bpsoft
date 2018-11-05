<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:29
 */

require 'app/models/Sell.php';
class SellController{
    private $crypt;
    private $menu;
    private $log;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->log = new Log();
    }

    //Vistas
    public function fastSell(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'sell/sell.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function rent(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'sell/rent.php';
        require _VIEW_PATH_ . 'footer.php';

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 17/10/2018
 * Time: 10:24
 */

class IndexController{
    private $crypt;
    private $menu;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
    }

    public function index(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'admin/index.php';
        require _VIEW_PATH_ . 'footer.php';
    }
}
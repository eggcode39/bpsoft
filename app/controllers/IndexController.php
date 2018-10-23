<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 17/10/2018
 * Time: 10:24
 */

class IndexController{
    public function __construct()
    {

    }

    public function index(){
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'admin/index.php';
        require _VIEW_PATH_ . 'footer.php';

    }
}
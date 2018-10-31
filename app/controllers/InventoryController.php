<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 24/10/2018
 * Time: 19:22
 */
require 'app/models/Inventory.php';
class InventoryController{
    private $crypt;
    private $menu;
    private $log;
    private $inventory;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->log = new Log();
        $this->inventory = new Inventory();
    }
    //Vistas
    public function listProducts(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $products = $this->inventory->listProducts();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/listproducts.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function addProduct(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/add.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Funciones
    //Controlador Listar Productos
    public function saveProduct(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_product'])){
                $model->id_product = $_POST['id_product'];
                $model->product_name = $_POST['product_name'];
                $model->product_description = $_POST['product_description'];
                $model->product_stock = $_POST['product_stock'];
                $result = $this->inventory->save($model);
            } else {
                $model->product_name = $_POST['product_name'];
                $model->product_description = $_POST['product_description'];
                $model->product_stock = $_POST['product_stock'];
                $result = $this->inventory->save($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveProduct');
            $result = 2;
        }

        echo $result;
    }
}
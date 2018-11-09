<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:29
 */
require 'app/models/Person.php';
require 'app/models/Sell.php';
require 'app/models/Inventory.php';
class SellController{
    private $crypt;
    private $menu;
    private $log;
    private $inventory;
    private $person;
    private $sell;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->log = new Log();
        $this->inventory = new Inventory();
        $this->person = new Person();
        $this->sell = new Sell();
    }

    //Vistas
    public function fastSell(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $products = $this->inventory->listProductprices();
        $people = $this->person->list();
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

    //Funciones
    public function sellProduct(){
        try{
            $id_user = $this->crypt->decrypt($_COOKIE['id_user'],_PASS_) ?? $this->crypt->decrypt($_SESSION['id_user'],_PASS_);
            $id_productforsale = $_POST['id_productforsale'];
            $id_person = $_POST['id_person'];
            $stocksale = $_POST['stocksale'];

            $person = $this->sell->listperson($id_person);
            $product = $this->sell->listproductsale($id_productforsale);

            $totalsale = $product[0]->product_price * $stocksale;
            $savesale = $this->sell->insertSale($id_person, $id_user,$totalsale);
            $savedetail = $this->sell->insertSaledetail($savesale[0]->id_saleproduct, $id_productforsale,$product[0]->product_name, $product[0]->product_unid, $product[0]->product_price, $stocksale);

            if($savedetail == 1){
                $reduce = $stocksale * $product[0]->product_unid;
                $this->sell->saveProductstock($reduce, $product[0]->id_product);
                $return = 1;
            } else {
                $return = 2;
            }


        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'SellController|sellProduct');
            $return = 2;
        }
        echo $return;
    }
}
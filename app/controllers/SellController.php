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
require 'app/models/Active.php';
class SellController{
    private $crypt;
    private $menu;
    private $log;
    private $inventory;
    private $person;
    private $sell;
    private $active;

    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->log = new Log();
        $this->inventory = new Inventory();
        $this->person = new Person();
        $this->sell = new Sell();
        $this->active = new Active();
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
        $rents = $this->inventory->listRents();
        $people = $this->person->list();
        $locations = $this->sell->listlocations();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'sell/rent.php';
        require _VIEW_PATH_ . 'footer.php';

    }

    public function viewRents(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $locations = $this->inventory->listlocations();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'sell/viewrents2.php';
        require _VIEW_PATH_ . 'footer.php';

    }

    //Funciones

    //VENDER PRODUCTO----------------------------------------------->
    public function sellProduct(){
        try{
            $id_turn = $this->active->getTurnactive();
            $id_user = $this->crypt->decrypt($_COOKIE['id_user'],_PASS_) ?? $this->crypt->decrypt($_SESSION['id_user'],_PASS_);
            $id_productforsale = $_POST['id_productforsale'];
            $id_person = $_POST['id_person'];
            $stocksale = $_POST['stocksale'];

            $product = $this->sell->listproductsale($id_productforsale);
            $totalsale = $product[0]->product_price * $stocksale;
            $cancelled = 'true';
            $type_sell = 'VENDER';
            if(isset($_POST['type_sell'])){
                $type_sell = $_POST['type_sell'];
                $cancelled = 'false';
            }

            if($type_sell == 'REGALAR'){
                $totalsale = 0;
                $cancelled = 'true';
            }

            $savesale = $this->sell->insertSale($id_person, $id_user,$id_turn,$totalsale,$cancelled);
            if(isset($_POST['type_sell'])){
                $savedetail = $this->sell->insertSaledetail($savesale[0]->id_saleproduct, $id_productforsale,$product[0]->product_name, $product[0]->product_unid, 0, $stocksale);
            } else {
                $savedetail = $this->sell->insertSaledetail($savesale[0]->id_saleproduct, $id_productforsale,$product[0]->product_name, $product[0]->product_unid, $product[0]->product_price, $stocksale);
            }

            if($savedetail == 1){
                $reduce = $stocksale * $product[0]->product_unid;
                $this->sell->saveProductstock($reduce, $product[0]->id_product);
                if($type_sell == 'FIAR'){
                    $this->sell->insertDebt($savesale[0]->id_saleproduct, $totalsale);
                }
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

    //ALQUILER PRODUCTO-------------------------------------------------->
    public function sellRent(){
        try{
            $id_turn = $this->active->getTurnactive();
            $id_user = $this->crypt->decrypt($_COOKIE['id_user'],_PASS_) ?? $this->crypt->decrypt($_SESSION['id_user'],_PASS_);
            $id_rent = $_POST['id_rent'];
            $id_person = $_POST['id_person'];
            $minutes_to_rent = $_POST['minutes_to_rent'];
            $totalprice = $_POST['totalprice'];
            $id_location = $_POST['id_location'];
            $type_sell = 'VENDER';
            $cancelled = 'true';

            if(isset($_POST['type_sell'])){
                $type_sell = $_POST['type_sell'];
                $cancelled = 'false';
            }

            if($type_sell == 'REGALAR'){
                $totalprice = 0;
                $cancelled = 'true';
            }

            $saverent = $this->sell->insertRent($id_rent,$id_person,$id_user,$id_turn,$id_location,$totalprice,$cancelled,$minutes_to_rent);
            $updatelocation = $this->sell->updateLocationstatus($id_location,1);

            $savelocationrent = $this->sell->insertLocacionrent($saverent[0]->id_salerent, $saverent[0]->id_location);

            if($updatelocation == 1){
                if($type_sell == 'FIAR'){
                    $this->sell->insertDebtrent($saverent[0]->id_salerent, $totalprice);
                }
                $return = 1;
            } else {
                $return = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'SellController|sellRent');
            $return = 2;
        }
        echo $return;
    }


    public function finishRent(){
        try{
            $id_salerent = $_POST['id_salerent'];
            $id_location = $_POST['id_location'];
            $id_locationrent = $_POST['id_locationrent'];

            $return = $this->sell->updateStatuslocationrent($id_salerent,$id_location,$id_locationrent);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'SellController|finishRent');
            $return = 2;
        }

        echo $return;
    }
}
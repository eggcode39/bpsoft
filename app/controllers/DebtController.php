<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 11/11/2018
 * Time: 17:05
 */
require 'app/models/Debt.php';
require 'app/models/Active.php';
class DebtController{
    private $crypt;
    private $menu;
    private $log;
    private $debt;
    private $active;

    public function __construct(){
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->log = new Log();
        $this->debt = new Debt();
        $this->active = new Active();
    }

    //Vistas
    public function seeAll(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $debtproducts = $this->debt->listdebts();
        $debtrents = $this->debt->listdebtsrent();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'debt/seeall.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Funciones
    //PAGAR DEUDA PRODUCTO-------------------------------------->
    public function payDebt(){
        try{
            $id_turn = $this->active->getTurnactive();
            $id_debt = $_POST['id_debt'];
            $debt_forpay = $_POST['debt_forpay'];
            $id_saleproduct = $_POST['id_saleproduct'];
            $mont = $_POST['mont'];

            $result = $this->debt->payDebt($id_debt, $mont);
            if($mont == $debt_forpay){
                $changestatusrent = $this->debt->updateDebt($id_debt);
                $changestatussale = $this->debt->updateStatussaleproduct($id_saleproduct);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|payDebt');
            $result = 2;
        }
        echo $result;
    }

    //PAGAR DEUDA ALQUILER------------------------------------------->
    public function payDebtrent(){
        try{
            $id_turn = $this->active->getTurnactive();
            $id_debtrent = $_POST['id_debtrent'];
            $debt_forpay = $_POST['debt_forpay'];
            $id_salerent = $_POST['id_salerent'];
            $mont = $_POST['mont'];

            $result = $this->debt->payDebtrent($id_debtrent, $mont);
            if($mont == $debt_forpay){
                $changestatusrent = $this->debt->updateDebtrent($id_debtrent);
                $changestatussale = $this->debt->updateStatussalerent($id_salerent);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|payDebtrent');
            $result = 2;
        }
        echo $result;

    }

}
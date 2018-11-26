<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 17/10/2018
 * Time: 10:24
 */
require 'app/models/Admin.php';
require 'app/models/Active.php';
require 'app/models/Report.php';
class IndexController{
    private $crypt;
    private $menu;
    private $admin;
    private $active;
    private $report;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->admin = new Admin();
        $this->active = new Active();
        $this->report = new Report();
    }

    public function index(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $users = $this->admin->count_users();
        $turn = $this->active->getTurnactiveall();

        $total_products = $this->report->total_products($turn);
        $total_rent = $this->report->total_rent($turn);
        $total_debt = $this->report->total_debt($turn);
        $total_debtrent = $this->report->total_debtrent($turn);

        $all_expense = $this->report->all_expense_number($turn);

        $final_report = $total_products + $total_rent + $total_debt + $total_debtrent - $all_expense;

        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'admin/index.php';
        require _VIEW_PATH_ . 'footer.php';
    }
}
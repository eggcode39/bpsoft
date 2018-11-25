<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 25/11/2018
 * Time: 1:37
 */

require 'app/models/Expense.php';
require 'app/models/Active.php';
class ExpenseController{
    private $crypt;
    private $menu;
    private $log;
    private $expense;
    private $active;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->log = new Log();
        $this->expense = new Expense();
        $this->active =  new Active();
    }

    //Vistas
    public function all(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $expenses = $this->expense->list();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'expense/all.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function add(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'expense/add.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function edit(){
        $id = $_GET['id'];
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $expense = $this->expense->listExpense($id);
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'expense/edit.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Funciones
    public function save(){
        try{
            $model = new Expense();
            if(isset($_POST['id_expense'])){
                $model->id_expense = $_POST['id_expense'];
                $model->expense_mont= $_POST['expense_mont'];
                $model->expense_description = $_POST['expense_description'];
                $result = $this->expense->save($model);
            } else {
                $model->id_turn = $this->active->getTurnactive();
                $model->expense_mont= $_POST['expense_mont'];
                $model->expense_description = $_POST['expense_description'];
                $result = $this->expense->save($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'ExpenseController|save');
            $result = 2;
        }

        echo $result;
    }

    //Borrar
    public function delete(){
        try{
            $id = $_POST['id'];
            $result = $this->expense->delete($id);

        } catch (Exception $e){
                $this->log->insert($e->getMessage(), 'ExpenseController|delete');
            $result = 2;
        }

        echo $result;
    }

}
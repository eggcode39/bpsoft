<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 25/11/2018
 * Time: 1:37
 */
class Expense{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Productos Registrados
    public function list(){
        try{
            $sql = "Select * from expense order by id_expense desc";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Expense|list');
            $result = 2;
        }

        return $result;
    }

    //Agregar o Editar Producto
    public function save($model){
        try {
            if(empty($model->id_expense)){
                $sql = 'insert into expense(
                    id_turn, expense_mont, expense_description
                    ) values(?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_turn,
                    $model->expense_mont,
                    $model->expense_description
                ]);

            } else {
                $sql = "update expense
                set
                expense_mont = ?,
                expense_description = ?
                where id_expense = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->expense_mont,
                    $model->expense_description,
                    $model->id_expense
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Expense|save');
            $result = 2;
        }

        return $result;
    }

    //Listar Producto Registrado
    public function listExpense($id){
        try{
            $sql = "Select * from expense where id_expense = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Expense|listExpense');
            $result = 2;
        }

        return $result;
    }

    //Eliminar Producto Registrado
    public function delete($id){
        try{
            $sql = "delete from expense where id_expense = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Expense|delete');
            $result = 2;
        }

        return $result;
    }
}
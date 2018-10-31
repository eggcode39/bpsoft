<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 29/10/2018
 * Time: 9:59
 */

class Inventory{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Productos Registrados
    public function listProducts(){
        try{
            $sql = "Select * from product";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProducts');
            $result = 2;
        }

        return $result;
    }

    //Agregar o Editar Producto
    public function save($model){
        try {
            if(empty($model->id_product)){
                $sql = 'insert into product(
                    product_name, product_description, product_stock
                    ) values(?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->product_name,
                    $model->product_description,
                    $model->product_stock
                ]);

            } else {
                $sql = "update product
                set
                product_name = ?,
                product_description = ?,
                product_stock = ?
                where id_product = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->product_name,
                    $model->product_description,
                    $model->product_stock,
                    $model->id_product
                ]);

            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Inventory|save');
            $result = 2;
        }

        return $result;
    }
}
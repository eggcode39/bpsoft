<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:29
 */

class Sell{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Traer Datos Persona
    public function listperson($id){
        $result = [];
        try {
            $sql = 'select * from person where id_person = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|listperson');
            $result = 2;
        }
        return $result;
    }

    //Traer Producto a Vender
    public function listproductsale($id){
        $result = [];
        try {
            $sql = 'select * from productforsale pr inner join product p on pr.id_product = p.id_product where pr.id_productforsale = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|listproductsale');
            $result = 2;
        }
        return $result;
    }

    //Insertar Datos En Detalle Venta
    public function insertSale($id_person,$id_user,$total){
        try{
            $date = date("Y-m-d H:i:s");
            $sql = 'insert into saleproduct(id_person, id_user, saleproduct_total, saleproduct_date) values(?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_person,
                $id_user,
                $total,
                $date
            ]);

            $sql2 = 'select id_saleproduct from saleproduct where saleproduct_date = ?';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([$date]);

            $result = $stm2->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|insertSale');
            $result = 0;
        }

        return $result;
    }

    public function insertSaledetail($id_saleproduct,$id_productforsale,$sale_productname,$sale_unid, $sale_price,$stocksale){
        try{
            $sql = 'insert into saledetail (id_saleproduct, id_productforsale, sale_productname, sale_unid, sale_price, sale_productsselled) values (?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_saleproduct,
                $id_productforsale,
                $sale_productname,
                $sale_unid,
                $sale_price,
                $stocksale
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|insertSaledetail');
            $result = 0;
        }
        return $result;
    }

    //Actualizar Stock
    public function saveProductstock($stock, $id){
        try {
            $sql = 'update product set product_stock = product_stock - ? where id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $stock,
                $id
            ]);

            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Sell|saveProductstock');
            $result = 2;
        }

        return $result;
    }


}
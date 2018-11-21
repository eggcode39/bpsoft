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

    //Traer Lista Locaciones
    public function listlocations(){
        $result = [];
        try {
            $sql = 'select * from location where location_status = 0 order by location_name asc';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|listlocations');
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
    public function insertSale($id_person,$id_user,$id_turn,$total,$cancelled){
        try{
            $date = date("Y-m-d H:i:s");
            $sql = 'insert into saleproduct(id_person, id_user, id_turn, saleproduct_total, saleproduct_date, saleproduct_cancelled) values(?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_person,
                $id_user,
                $id_turn,
                $total,
                $date,
                $cancelled
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


    //Insertar Deuda
    public function insertDebt($id_saleproduct, $debt_total){
        try{
            $sql = 'insert into debt (id_saleproduct, debt_total, debt_cancelled, debt_status) values (?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_saleproduct,
                $debt_total,
                0,
                0
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|insertDebt');
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

    //Insertar Venta Renta
    public function insertRent($id_rent,$id_person,$id_user,$id_turn,$id_location,$totalprice,$cancelled,$minutes){
        try{
            $date = date("Y-m-d");
            $start = date("H:i:s");
            $starseconds = strtotime($start);
            $seconds_to_add = $minutes * 60;
            $finish = date("H:i:s", $starseconds + $seconds_to_add);
            $sql = 'insert into salerent (id_rent, id_person, id_user,id_turn, id_location, salerent_date, salerent_start, salerent_finish, salerent_total, salerent_finished, salerent_cancelled) values (?,?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_rent,
                $id_person,
                $id_user,
                $id_turn,
                $id_location,
                $date,
                $start,
                $finish,
                $totalprice,
                0,
                $cancelled
            ]);
            $sql2 = 'select id_salerent, id_location from salerent where salerent_date = ? and salerent_start = ? and id_location = ?';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([$date, $start, $id_location]);
            $result = $stm2->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|insertRent');
            $result = 0;
        }

        return $result;
    }

    //Insertar Locacion Alquiler
    public function insertLocacionrent($id_salerent, $id_locacion){
        try {
            $sql = 'insert into locationrent (id_salerent, id_location) values (?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_salerent,
                $id_locacion
            ]);

            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Sell|insertLocacionrent');
            $result = 2;
        }

        return $result;
    }

    //Insertar Deuda Alquiler
    public function insertDebtrent($id_salerent, $debt_total){
        try{
            $sql = 'insert into debtrent (id_salerent, debtrent_total, debtrent_cancelled, debtrent_status) values (?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_salerent,
                $debt_total,
                0,
                0
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|insertDebt');
            $result = 0;
        }

        return $result;
    }

    public function updateLocationstatus($id_location, $status){
        try{
            $sql = 'update location set location_status = ? where id_location = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $status,
                $id_location
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|updateLocationstatus');
            $result = 2;
        }

        return $result;
    }

    public function selectLocationstatus($id_location){
        try{
            $sql = 'select * from location l inner join locationrent lr on l.id_location = lr.id_location inner join salerent s on s.id_salerent = lr.id_salerent where lr.id_location = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_location]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|selectLocationstatus');
            $result = 2;
        }
        return $result;
    }

    public function updateStatuslocationrent($id_salerent, $id_location, $id_locationrent){
        try{
            $sql1 = 'update salerent set salerent_finished = 1 where id_salerent = ?';
            $stm1 = $this->pdo->prepare($sql1);
            $stm1->execute([$id_salerent]);

            $sql2 = 'update location set location_status = 0 where id_location = ?';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([$id_location]);

            $sql3 = 'delete from locationrent where id_locationrent = ?';
            $stm3 = $this->pdo->prepare($sql3);
            $stm3->execute([$id_locationrent]);

            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|updateStatuslocationrent');
            $result = 2;
        }
        return $result;
    }


}
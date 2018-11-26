<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 22/11/2018
 * Time: 18:07
 */

class Report{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }
    //Funcion Listar Todos los Productos
    public function listP(){
        try{
            $sql = 'select * from product';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|listP');
            $result = 0;
        }
        return $result;
    }

    //Listar Inventario Inicial
    public function initial_inventory($turn, $id_product){
        try{
            $sql = 'select startproduct_stock from startproduct where id_turn = ? and id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn,
                $id_product
            ]);
            $r = $stm->fetch();
            $result = $r->startproduct_stock;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|initial_inventory');
            $result = 0;
        }
        return $result;
    }

    public function stockadded($turn, $id_product){
        try{
            $sql = 'select stocklog_added from stocklog where id_turn = ? and id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn,
                $id_product
            ]);
            $r = $stm->fetch();
            $result = $r->stocklog_added;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|stockadded');
            $result = 0;
        }
        return $result;
    }

    public function products_selled($turn, $id_product){
        try{
            $sql = "select sum(s.sale_productstotalselled) total from saleproduct sp inner join saledetail s on sp.id_saleproduct = s.id_saleproduct inner join productforsale p on s.id_productforsale = p.id_productforsale
                    where sp.id_turn = ? and p.id_product = ? and sp.saleproduct_total <> 0 and sp.saleproduct_cancelled <> 'false'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn,
                $id_product
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|products_selled');
            $result = 0;
        }
        return $result;
    }

    public function products_free($turn, $id_product){
        try{
            $sql = "select sum(s.sale_productstotalselled) total from saleproduct sp inner join saledetail s on sp.id_saleproduct = s.id_saleproduct inner join productforsale p on s.id_productforsale = p.id_productforsale
                    where sp.id_turn = ? and p.id_product = ? and sp.saleproduct_total = 0 ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn,
                $id_product
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|products_free');
            $result = 0;
        }
        return $result;
    }

    public function products_debt($turn, $id_product){
        try{
            $sql = "select sum(s.sale_productstotalselled) total from saleproduct sp inner join saledetail s on sp.id_saleproduct = s.id_saleproduct inner join productforsale p on s.id_productforsale = p.id_productforsale
                    where sp.id_turn = ? and p.id_product = ? and sp.saleproduct_cancelled = 'false'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn,
                $id_product
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|products_debt');
            $result = 0;
        }
        return $result;
    }

    public function total_per_product($turn, $id_product){
        try{
            $sql = "select sum(sp.saleproduct_total) total from saleproduct sp inner join saledetail s on sp.id_saleproduct = s.id_saleproduct inner join productforsale p on s.id_productforsale = p.id_productforsale
                    where sp.id_turn = ? and p.id_product = ? and sp.saleproduct_total <> 0 and sp.saleproduct_cancelled <> 'false'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn,
                $id_product
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|total_per_product');
            $result = 0;
        }
        return $result;
    }

    public function total_products_now($id_product){
        try{
            $sql = 'select product_stock from product where id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_product
            ]);
            $r = $stm->fetch();
            $result = $r->product_stock;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|total_products_now');
            $result = 0;
        }
        return $result;
    }

    //Calcular ganancias Productos
    public function total_products($turn){
        try{
            $sql = "select sum(sp.saleproduct_total) total from saleproduct sp inner join saledetail s on sp.id_saleproduct = s.id_saleproduct inner join productforsale p on s.id_productforsale = p.id_productforsale
                    where sp.id_turn = ?  and sp.saleproduct_total <> 0 and sp.saleproduct_cancelled <> 'false'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|total_per_product');
            $result = 0;
        }
        return $result;
    }

    //Calcular ganancias Alquiler
    public function total_rent($turn){
        try{
            $sql = "select sum(salerent_total) total from salerent where id_turn = ? and salerent_total <> 0 and salerent_cancelled = 'true'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|total_rent');
            $result = 0;
        }
        return $result;
    }

    //Calcular ganancias Deuda
    public function total_debt($turn){
        try{
            $sql = "select sum(debtpay_mont) total from debtpay where id_turn = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|total_rent');
            $result = 0;
        }
        return $result;
    }

    //Calcular ganancias Deuda Alquiler
    public function total_debtrent($turn){
        try{
            $sql = 'select sum(debtrentpay_mont) total from debtrentpay where id_turn = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|total_rent');
            $result = 0;
        }
        return $result;
    }

    //Egresos
    public function all_expense($turn){
        try{
            $sql = 'select * from expense where id_turn = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn
            ]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|total_rent');
            $result = 0;
        }
        return $result;
    }

    public function all_expense_number($turn){
        try{
            $sql = 'select sum(expense_mont) total from expense where id_turn = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $turn->id_turn
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Report|total_rent');
            $result = 0;
        }
        return $result;
    }


}
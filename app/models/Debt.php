<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 11/11/2018
 * Time: 17:03
 */

class Debt{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function listdebtsrent(){
        try{
            $sql = 'select * from salerent s inner join person p on s.id_person = p.id_person inner join debtrent d on s.id_salerent = d.id_salerent inner join rent r on s.id_rent = r.id_rent where d.debtrent_status = 0';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|listdebtsrent');
            $result = 2;
        }

        return $result;
    }

    public function listdebts(){
        try{
            $sql = 'select * from saleproduct s inner join person p on s.id_person = p.id_person inner join debt d on s.id_saleproduct = d.id_saleproduct inner join saledetail s2 on s.id_saleproduct = s2.id_saleproduct inner join productforsale p2 on s2.id_productforsale = p2.id_productforsale inner join product p3 on p2.id_product = p3.id_product where d.debt_status = 0';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|listdebts');
            $result = 2;
        }
        return $result;
    }

    public function payDebt($id_debt, $paydebt){
        try{
            $sql = 'update debt set debt_cancelled = debt_cancelled + ? where id_debt = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $paydebt,
                $id_debt
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|payDebt');
            $result = 2;
        }
        return $result;
    }

    public function updateDebt($id_debt){
        try{
            $sql = 'update debt set debt_status = 1 where id_debt = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_debt
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|updateDebt');
            $result = 2;
        }
        return $result;
    }

    public function updateStatussaleproduct($id_saleproduct){
        try{
            $sql = 'update saleproduct set saleproduct_cancelled = ? where id_saleproduct = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                'true',
                $id_saleproduct
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|updateStatussaleproduct');
            $result = 2;
        }
        return $result;
    }

    public function payDebtrent($id_debtrent, $paydebt){
        try{
            $sql = 'update debtrent set debtrent_cancelled = debtrent_cancelled + ? where id_debtrent = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $paydebt,
                $id_debtrent
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|payDebtrent');
            $result = 2;
        }
        return $result;
    }

    public function updateDebtrent($id_debtrent){
        try{
            $sql = 'update debtrent set debtrent_status = 1 where id_debtrent = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_debtrent
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|updateDebtrent');
            $result = 2;
        }
        return $result;
    }

    public function updateStatussalerent($id_salerent){
        try{
            $sql = 'update salerent set salerent_cancelled = ? where id_salerent = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                'true',
                $id_salerent
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Debt|updateStatussalerent');
            $result = 2;
        }
        return $result;
    }
}
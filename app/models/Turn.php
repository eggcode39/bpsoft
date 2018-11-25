<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 19/11/2018
 * Time: 10:10
 */

class Turn{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function listall(){
        try{
            $sql = 'select * from turn';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $return = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|listall');
            $return = 2;
        }

        return $return;
    }

    public function save($model){
        try{
            $sql = 'insert into turn (turn_datestart, turn_datefinish, turn_active, turn_wasactive) values (?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->turn_datestart,
                $model->turn_datefinish,
                0,
                0
            ]);
            $return = 1;

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|save');
            $return = 2;
        }
        return $return;
    }

    public function delete($id){
        try{
            $sql = 'delete from turn where id_turn = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id
            ]);
            $return = 1;

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|save');
            $return = 2;
        }
        return $return;
    }

    public function change($id){
        try{
            $sql1 = 'update turn set turn_active = 0 where turn_active = 1';
            $stm1 = $this->pdo->prepare($sql1);
            $stm1->execute();

            $sql = 'update turn set turn_active = 1, turn_wasactive = 1 where id_turn = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id
            ]);
            $return = 1;

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|change');
            $return = 2;
        }
        return $return;
    }

    public function getTurnactive(){
        try{
            $sql = 'select id_turn from turn where turn_active = 1 limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch();
            $return = $result->id_turn;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|getTurnactive');
            $return = 0;
        }
        return $return;
    }

    //Funcion Especial para Listar Los Productos
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

    public function setStock($productos, $id_turn){
        try {
            $sql = 'insert into startproduct(id_turn, id_product, startproduct_stock) values ';
            $firstvalue = true;
            foreach ($productos as $p){
                if($firstvalue){
                    $sql = $sql . '('.$id_turn.','.$p->id_product.','.$p->product_stock.')';
                    $firstvalue = false;
                } else {
                    $sql = $sql . ',('.$id_turn.','.$p->id_product.','.$p->product_stock.')';
                }

            }
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = 1;

        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, "Turn|setStock");
            $result = 2;
        }
        return $result;

    }
}
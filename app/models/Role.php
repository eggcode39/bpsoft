<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:34
 */

class Role{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function save($model){
        try {
            if(empty($model->id_role)){
                $sql = 'insert into role(
                    role_name,
                    role_description
                    ) values(?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->role_name,
                    $model->role_description
                ]);
                $result = 1;
            } else {
                $sql = "
                    update role
                    set
                    role_name = ?,
                    role_description = ?
                    where id_role = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->role_name,
                    $model->role_description,
                    $model->id_rol
                ]);
                $result = 1;
            }

        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, "Role|save");
            $result = 2;
        }
        return $result;
    }

    public function insertPermits($model){
        try {
            $permits = explode('.', $model->permits);
            $sql = 'insert into rolepermit (id_role, id_permit) values ';
            $firstvalue = true;
            foreach ($permits as $permit){
                if($firstvalue){
                    $sql = $sql . '('.$model->id_role.','.$permit.')';
                    $firstvalue = false;
                } else {
                    $sql = $sql . ',('.$model->id_role.','.$permit.')';
                }

            }
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = 1;

        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, "Role|insertPermits");
            $result = 2;
        }
        return $result;
    }

    public function deleteRole($id){
        try{
            $sql = "delete from role where id_role = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, 'Role|deleteRole');
            $result = 2;
        }

        return $result;
    }

    public function deletePermit($model){
        try{
            $sql = "delete from rolepermit where id_role = ? and id_permit = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_role,
                $model->id_permit
            ]);
            $result = 1;
        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, 'Role|deletePermit');
            $result = 2;
        }
        return $result;
    }

    public function readPermits($id_role){
        $result = [];
        try{
            $sql = "select p.permit_controller, p.permit_action, p.permit_status from rolepermit r2 inner join permit p on r2.id_permit = p.id_permit where r2.id_role = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_role]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Role|readPermits');
            $result = 2;
        }
        return $result;

    }

    public function readPermitscontroller($id_role, $controller){
        $result = [];
        try{
            $sql = "select p.permit_controller, p.permit_action, p.permit_status from rolepermit r2 inner join permit p on r2.id_permit = p.id_permit where r2.id_role = ? and p.permit_controller = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_role, $controller]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Role|readPermitscontroller');
            $result = 2;
        }
        return $result;

    }

    public function readPermitsview($id_role, $controller){
        $result = [];
        try{
            $sql = "SELECT m.menu_name, o.option_name, o.option_url FROM role r inner join rolemenu rm on r.id_role = rm.id_rolemenu inner join menu m on m.id_menu = rm.id_menu inner join optionmenu o on o.id_menu = m.id_menu where r.id_role = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_role, $controller]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Role|readPermitscontroller');
            $result = 2;
        }
        return $result;

    }

}
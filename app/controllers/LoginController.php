<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:49
 */

require 'app/models/Login.php';
class LoginController{
    private $log;
    private $pdo;
    private $login;
    private $crypt;
    public function __construct()
    {
        $this->log = new Log();
        $this->pdo = Database::getConnection();
        $this->login = new Login();
        $this->crypt = new Crypt();
    }

    public function index(){
        require _VIEW_PATH_ . 'login/login.php';
    }

    public function singIn(){
        try{
            $model = new Login();
            $model->user_nickname = $_POST['user_nickname'];
            $password = $_POST['user_password'];
            $singin = $this->login->singIn($model);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Login|singIn');
        }

        if($singin == 2 || $singin == 3){
            echo $singin;

        } else {
            if(password_verify($password, $singin[0]->user_password)){

                /*
                setcookie('id_user', $this->crypt->encrypt($singin[0]->id_user, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('id_person', $this->crypt->encrypt($singin[0]->id_user, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('user_nickname', $this->crypt->encrypt($singin[0]->user_nickname, 'zxcvbnm'), time() + 365 * 24 * 60 * 60);
                setcookie('user_image', $this->crypt->encrypt($singin[0]->user_image, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('user_email', $this->crypt->encrypt($singin[0]->user_email, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('user_last_login', $this->crypt->encrypt($singin[0]->user_last_login, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('person_name', $this->crypt->encrypt($singin[0]->person_name, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('person_surname', $this->crypt->encrypt($singin[0]->person_surname, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('person_coord_x', $this->crypt->encrypt($singin[0]->person_coord_x, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('person_coord_y', $this->crypt->encrypt($singin[0]->person_coord_y, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('person_genre', $this->crypt->encrypt($singin[0]->person_genre, 'zxcvbnm'), time() + 30 * 24 * 60 * 60);
                setcookie('person_role', $this->crypt->encrypt($singin[0]->person_role, 'zxcvbnm'), time() + 30* 24 * 60 * 60);

                $_SESSION['id_user'] = $this->crypt->encrypt($singin[0]->id_user, 'zxcvbnm');
                $_SESSION['id_person'] = $this->crypt->encrypt($singin[0]->id_user, 'zxcvbnm');
                $_SESSION['user_nickname'] = $this->crypt->encrypt($singin[0]->user_nickname, 'zxcvbnm');
                $_SESSION['user_image'] = $this->crypt->encrypt($singin[0]->user_image, 'zxcvbnm');
                $_SESSION['user_email'] = $this->crypt->encrypt($singin[0]->user_email, 'zxcvbnm');
                $_SESSION['user_last_login'] = $this->crypt->encrypt($singin[0]->user_last_login, 'zxcvbnm');
                $_SESSION['person_name'] = $this->crypt->encrypt($singin[0]->person_name, 'zxcvbnm');
                $_SESSION['person_surname'] = $this->crypt->encrypt($singin[0]->person_surname, 'zxcvbnm');
                $_SESSION['person_coord_x'] = $this->crypt->encrypt($singin[0]->person_coord_x, 'zxcvbnm');
                $_SESSION['person_coord_y'] = $this->crypt->encrypt($singin[0]->person_coord_y, 'zxcvbnm');
                $_SESSION['person_genre'] = $this->crypt->encrypt($singin[0]->person_genre, 'zxcvbnm');
                $_SESSION['role'] = $this->crypt->encrypt($singin[0]->id_role, 'zxcvbnm');*/
                //echo json_encode($singin);
                //echo $singin;
                echo 1;
            } else {
                echo 3;
            }
        }

    }

    public function singOut(){
        try{
            unset($_SESSION['id_user']);
            unset($_SESSION['id_person']);
            unset($_SESSION['user_nickname']);
            unset($_SESSION['user_image']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_last_login']);
            unset($_SESSION['person_name']);
            unset($_SESSION['person_surname']);
            unset($_SESSION['person_coord_x']);
            unset($_SESSION['person_coord_y']);
            unset($_SESSION['person_genre']);
            unset($_SESSION['role']);
            session_destroy();

            setcookie('id_user', '1', time() - 365 * 24 * 60 * 60);
            setcookie('id_person', '1', time() - 365 * 24 * 60 * 60);
            setcookie('user_nickname', '1', time() - 365 * 24 * 60 * 60);
            setcookie('user_image', '1', time() - 365 * 24 * 60 * 60);
            setcookie('user_email', '1', time() - 365 * 24 * 60 * 60);
            setcookie('user_last_login', '1', time() - 365 * 24 * 60 * 60);
            setcookie('person_name', '1', time() - 365 * 24 * 60 * 60);
            setcookie('person_surname', '1', time() - 365 * 24 * 60 * 60);
            setcookie('person_coord_x', '1', time() - 365 * 24 * 60 * 60);
            setcookie('person_coord_y', '1', time() - 365 * 24 * 60 * 60);
            setcookie('person_genre', '1', time() - 365 * 24 * 60 * 60);
            setcookie('person_role', '1', time() - 365 * 24 * 60 * 60);
            $okey = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'singOut|LoginController');
            $okey = 2;
        }
        echo $okey;
    }
}
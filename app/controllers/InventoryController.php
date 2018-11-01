<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 24/10/2018
 * Time: 19:22
 */
require 'app/models/Inventory.php';
class InventoryController{
    private $crypt;
    private $menu;
    private $log;
    private $inventory;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->menu = new Menu();
        $this->log = new Log();
        $this->inventory = new Inventory();
    }
    //Vistas
    //Producto
    public function listProducts(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $products = $this->inventory->listProducts();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/listproducts.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function addProduct(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/add.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function editProduct(){
        $idp = $_GET['id'];
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $product = $this->inventory->listProduct($idp);
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/edit.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function productForsale(){
        $idp = $_GET['id'];
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $products = $this->inventory->listProductsforsale($idp);
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/listproductsale.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function addProductforsale(){
        $idp = $_GET['id'];
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $product = $this->inventory->listProductname($idp);
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/addproductsale.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function editProductforsale(){
        $idp = $_GET['id'];
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $productprice = $this->inventory->listProductprice($idp);
        $product = $this->inventory->listProductname($productprice->id_product);
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/editproductsale.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Renta
    public function listRent(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $rents = $this->inventory->listRents();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/listrent.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function addRent(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/addrent.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function editRent(){
        $idp = $_GET['id'];
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $rent = $this->inventory->listRent($idp);
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/editrent.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Objetos
    public function listObjects(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $objects = $this->inventory->listObjects();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/listobjects.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function addObject(){
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/addobject.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    public function editObject(){
        $idp = $_GET['id'];
        $navs = $this->menu->listMenu($this->crypt->decrypt($_COOKIE['role'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role'],_PASS_));
        $object = $this->inventory->listObject($idp);
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'inventory/editobject.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Funciones
    //Guardar Edicion o Nuevos Productos
    public function saveProduct(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_product'])){
                $model->id_product = $_POST['id_product'];
                $model->product_name = $_POST['product_name'];
                $model->product_description = $_POST['product_description'];
                $model->product_stock = $_POST['product_stock'];
                $result = $this->inventory->save($model);
            } else {
                $model->product_name = $_POST['product_name'];
                $model->product_description = $_POST['product_description'];
                $model->product_stock = $_POST['product_stock'];
                $result = $this->inventory->save($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveProduct');
            $result = 2;
        }

        echo $result;
    }
    //Borrar Productos
    public function deleteProduct(){
        try{
            $id_product = $_POST['id'];
            $result = $this->inventory->deleteProduct($id_product);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|deleteRent');
            $result = 2;
        }

        echo $result;
    }
    //Guardar Edicion o Nuevo Precio Producto
    public function saveProductprice(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_productforsale'])){
                $model->id_productforsale = $_POST['id_productforsale'];
                $model->product_unid = $_POST['product_unid'];
                $model->product_price = $_POST['product_price'];
                $result = $this->inventory->saveprice($model);
            } else {
                $model->id_product = $_POST['id_product'];
                $model->product_unid = $_POST['product_unid'];
                $model->product_price = $_POST['product_price'];
                $result = $this->inventory->saveprice($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveProductprice');
            $result = 2;
        }
        echo $result;
    }
    //Borrar Precio Producto
    public function deleteProductprice(){
        try{
            $id_productforsale = $_POST['id'];
            $result = $this->inventory->deleteProductprice($id_productforsale);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|deleteProductprice');
            $result = 2;
        }

        echo $result;
    }

    //Guardar Edicion o Nuevos Alquileres
    public function saveRent(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_rent'])){
                $model->id_rent = $_POST['id_rent'];
                $model->rent_name = $_POST['rent_name'];
                $model->rent_description = $_POST['rent_description'];
                $model->rent_timeminutes = $_POST['rent_timeminutes'];
                $model->rent_cost = $_POST['rent_cost'];
                $result = $this->inventory->saveRent($model);
            } else {
                $model->rent_name = $_POST['rent_name'];
                $model->rent_description = $_POST['rent_description'];
                $model->rent_timeminutes = $_POST['rent_timeminutes'];
                $model->rent_cost = $_POST['rent_cost'];
                $result = $this->inventory->saveRent($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveRent');
            $result = 2;
        }

        echo $result;
    }

    //Borrar Alquiler
    public function deleteRent(){
        try{
            $id_rent = $_POST['id'];
            $result = $this->inventory->deleteRent($id_rent);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|deleteRent');
            $result = 2;
        }

        echo $result;
    }

    //Guardar Edicion o Nuevos Objetos
    public function saveObject(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_object'])){
                $model->id_object = $_POST['id_object'];
                $model->object_name = $_POST['object_name'];
                $model->object_description = $_POST['object_description'];
                $model->object_total = $_POST['object_total'];
                $result = $this->inventory->saveObject($model);
            } else {
                $model->object_name = $_POST['object_name'];
                $model->object_description = $_POST['object_description'];
                $model->object_total = $_POST['object_total'];
                $result = $this->inventory->saveObject($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveObject');
            $result = 2;
        }
        echo $result;
    }

    //Borrar Objeto
    public function deleteObject(){
        try{
            $id_object = $_POST['id'];
            $result = $this->inventory->deleteObject($id_object);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|deleteObject');
            $result = 2;
        }

        echo $result;
    }

}
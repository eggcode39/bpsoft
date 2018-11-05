<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:36
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Venta
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Venta</a></li>
            <li class="active">Realizar Venta Rapida</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <center><h2>VENTA DE PRODUCTOS</h2></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <center><h2>ggg</h2></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-8">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID Interno</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($products as $product){
                        ?>
                        <tr>
                            <td><?php echo $product->id_product;?></td>
                            <td><?php echo $product->product_name;?></td>
                            <td><?php echo $product->product_description;?></td>
                            <td><?php echo $product->product_stock;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>Inventory/editProduct/<?php echo $product->id_product;?>">Editar</a><a class="btn btn-chico btn-danger btn-xs" onclick="preguntarSiNo(<?php echo $product->id_product;?>)">Eliminar</a><a class="btn btn-dropbox btn-xs" href="<?php echo _SERVER_;?>Inventory/productForsale/<?php echo $product->id_product;?>">Ver Costo Venta</a><a class="btn btn-info btn-xs" href="<?php echo _SERVER_;?>Inventory/addProductstock/<?php echo $product->id_product;?>">Agregar Stock</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID Interno</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-lg-4">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($people as $person){
                        ?>
                        <tr>
                            <td><?php echo $product->id_product;?></td>
                            <td><?php echo $product->product_name;?></td>
                            <td><?php echo $product->product_description;?></td>
                            <td><?php echo $product->product_stock;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>Inventory/editProduct/<?php echo $product->id_product;?>">Editar</a><a class="btn btn-chico btn-danger btn-xs" onclick="preguntarSiNo(<?php echo $product->id_product;?>)">Eliminar</a><a class="btn btn-dropbox btn-xs" href="<?php echo _SERVER_;?>Inventory/productForsale/<?php echo $product->id_product;?>">Ver Costo Venta</a><a class="btn btn-info btn-xs" href="<?php echo _SERVER_;?>Inventory/addProductstock/<?php echo $product->id_product;?>">Agregar Stock</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID Interno</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
        $("#example2").DataTable();
    });

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este producto?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id){
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Inventory/deleteProduct",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Producto Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>

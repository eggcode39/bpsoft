<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 31/10/2018
 * Time: 9:25
 */?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Inventario</a></li>
            <li class="active">Listar Precios Por Producto</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Gestion de Precios de Producto</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Inventory/addProductforsale/<?php echo $idp;?>" >Agregar Nuevo</a></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID Interno</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($products as $product){
                        ?>
                        <tr>
                            <td><?php echo $product->id_productforsale;?></td>
                            <td><?php echo $product->product_name;?></td>
                            <td><?php echo $product->product_unid;?></td>
                            <td>S/. <?php echo $product->product_price;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>Inventory/editProductforsale/<?php echo $product->id_productforsale;?>">Editar</a><a class="btn btn-chico btn-danger btn-xs" onclick="preguntarSiNo(<?php echo $product->id_productforsale;?>)">Eliminar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID Interno</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
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
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este precio?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id){
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Inventory/deleteProductprice",
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

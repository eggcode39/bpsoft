
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
            <li class="active">Listar Productos</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Gestion de Productos</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Inventory/addProduct" >Agregar Nuevo</a></center>
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
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>Inventory/editProduct/<?php echo $product->id_product;?>">Editar</a><a class="btn btn-chico btn-danger btn-xs" type="button">Eliminar</a></td>
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
</script>

<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 30/10/2018
 * Time: 0:29
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Agregar Productos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inventario</a></li>
            <li><a href="#">Agregar</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Inventory/listProducts" >Volver</a>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Producto a Agregar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre Producto</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Ingresar Nombre Producto...">
                            </div>
                            <div class="form-group">
                                <label >Descripcion Producto</label>
                                <input type="text" class="form-control" id="product_description" placeholder="Ingresar Descripción Producto...">
                            </div>
                            <div class="form-group">
                                <label >Stock Producto</label>
                                <input type="text" class="form-control" id="product_stock" placeholder="Ingresar Stock Producto...">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Agregar Producto</button>
                        </div>
                    </div>
                </div>
                <!-- /.box -->



            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    function add() {
        var valor = "correcto";
        var product_name = $('#product_name').val();
        var product_description = $('#product_description').val();
        var product_stock = $('#product_stock').val();

        if(product_name == ""){
            alertify.error('El campo Nombre Producto está vacío');
            $('#product_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_name').css('border','');
        }

        if(product_name == ""){
            alertify.error('El campo Nombre Producto está vacío');
            $('#product_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_name').css('border','');
        }

        if(product_description == ""){
            alertify.error('El campo Description Producto está vacío');
            $('#product_description').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_description').css('border','');
        }

        if(product_stock == ""){
            alertify.error('El campo Stock Producto está vacío');
            $('#product_stock').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_stock').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "product_name=" + product_name +
                "&product_description=" + product_description +
                "&product_stock=" + product_stock;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Inventory/saveProduct",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Inventory/listProducts';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>
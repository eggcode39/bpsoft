<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 31/10/2018
 * Time: 10:08
 */?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Agregar Precio Venta</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inventario</a></li>
            <li><a href="#">Agregar Precio Venta</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Inventory/productForsale/<?php echo $idp;?>" >Volver</a>
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
                        <h3 class="box-title">Precio a Agregar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >ID - Nombre Producto</label>
                                <input type="text" class="form-control" id="id_product" value="<?php echo $product->id_product . ' - ' . $product->product_name;?>" readonly>
                            </div>
                            <div class="form-group">
                                <label >Unidades a Vender</label>
                                <input type="text" class="form-control" id="product_unid" onkeypress="return valida(event)" placeholder="Ingresar Cantidad de Unidades a Vender...">
                            </div>
                            <div class="form-group">
                                <label >Precio Total</label>
                                <input type="text" class="form-control" id="product_price" placeholder="Ingresar Precio Total...">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Agregar Precio</button>
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
    function valida(e){
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla==8){
            return true;
        }
        // Patron de entrada, en este caso solo acepta numeros
        patron =/[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }

    function add() {
        var valor = "correcto";
        var id_product = <?php echo $product->id_product;?>;
        var product_unid = $('#product_unid').val();
        var product_price = $('#product_price').val();

        if(product_unid == ""){
            alertify.error('El campo Unidades a Vender está vacío');
            $('#product_unid').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_unid').css('border','');
        }

        if(product_price == ""){
            alertify.error('El campo Precio Producto está vacío');
            $('#product_price').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_price').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "id_product=" + id_product +
                "&product_unid=" + product_unid +
                "&product_price=" + product_price;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Inventory/saveProductprice",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Inventory/productForsale/<?php echo $idp;?>';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }
</script>

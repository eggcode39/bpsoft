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
                <center><h2>VENTA RÁPIDA DE PRODUCTOS</h2></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-6">
                <label style="font-size: 22px;padding-right: 10px;">Cliente a Vender: </label>
                <input style="font-size: 22px;padding-left: 8px;width: 450px;" type="text" value="0000000 - Anonymus Young" id="name_person" readonly>
                <input type="text" id="id_persona" style="display: none" value="2">
            </div>
            <div class="col-xs-6">
                <label style="font-size: 22px"> Cantidad del Producto a Vender: </label>
                <input  style="font-size: 22px;width: 65px;padding-left: 10px;" type="number" value="1" id="product_sale">
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-8">
                <center><h2>Productos</h2></center>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Tipo de Venta</th>
                        <th>Precio</th>
                        <th style="width: 250px">Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($products as $product){
                        ?>
                        <tr>
                            <td class="texto-venta"><?php echo $product->product_name;?></td>
                            <td class="texto-venta"><?php echo $product->product_stock;?></td>
                            <td class="texto-venta">Venta por <?php echo $product->product_unid;?></td>
                            <td class="texto-venta">S/. <?php echo $product->product_price;?></td>
                            <td><a class="btn btn-grande btn-success btn-xs" type="button" onclick="preguntarSiNo(<?php echo $product->id_productforsale;?>, '<?php echo $product->product_name;?>',<?php echo $product->product_stock?>,<?php echo $product->product_price;?>,<?php echo $product->product_unid;?>)">Venta Rapida</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Tipo de Venta</th>
                        <th>Precio</th>
                        <th style="width: 250px">Acción</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-lg-4">
                <center><h2>Clientes</h2></center>
                <table id="example3" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($people as $person){
                        $espacio = ' ';
                        ?>
                        <tr>
                            <td><?php echo $person->person_name;?></td>
                            <td><?php echo $person->person_surname;?></td>
                            <td><?php echo $person->person_dni;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" onclick="agregarPersona('<?php echo $person->person_name . $espacio . $person->person_surname;?>', '<?php echo $person->person_dni;?>', <?php echo $person->id_person;?>)">Agregar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
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
    var id_person = $("#id_persona").val();
    var nameperson = 'Anonymus';
    $(function () {
        $("#example2").DataTable();
        $("#example3").DataTable();
    });

    function agregarPersona(nombres, dni, id) {
        $("#name_person").val(dni + ' - ' + nombres);
        $("#id_persona").val(id);
        id_person = id;
        nameperson = nombres;
    }

    function preguntarSiNo(id_product,nameproduct,stock_general,price,unidforsale){
        var unid_sale = $("#product_sale").val();
        var id_persona = id_person;
        var totalprice = price * unid_sale;
        var unid_to_sale = unidforsale * unid_sale;
        if(stock_general >= unid_to_sale){
            alertify.confirm('Realizar Venta', '¿Esta seguro que desea vender ' + unid_sale +' unidades de ' + nameproduct +' a ' + nameperson + ' por S./ ' + price +' soles? Precio a Cobrar: S/. ' + totalprice + ' soles.',
                function(){ vender(id_product, id_persona, unid_sale, totalprice) }
                , function(){ alertify.error('Operacion Cancelada')});
        } else {
            alertify.error('ERROR: STOCK INSUFICIENTE');
        }
    }

    function vender(id_productforsale, id_person, stocksale){
        var cadena = "id_productforsale=" + id_productforsale +
                    "&id_person=" + id_person +
                    "&stocksale=" + stocksale;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Sell/sellProduct",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Venta Realizada');
                    location.reload();
                } else {
                    alertify.error('No se pudo llevar acabo la venta');
                }
            }
        });
    }
</script>

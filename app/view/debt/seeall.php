<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 11/11/2018
 * Time: 17:08
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Deudas</a></li>
            <li class="active">Listar Deudas</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <center><h2>Gestion de Deudas</h2></center>
            </div>
            <!--<div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Inventory/addProduct" >Agregar Nuevo</a></center>
            </div>-->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <center><label style="padding-right: 10px;">Monto a Cobrar: </label><input type="text"  placeholder="Ingrese monto a cobrar..." id="monto_deuda" style="width: 200px;padding-left: 5px;"></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <center><h4>Deudas en Productos</h4></center>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Producto</th>
                        <th>Monto Deuda Total</th>
                        <th>Monto Cancelado</th>
                        <th>Monto Por Cancelar</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($debtproducts as $m){
                        ?>
                        <tr>
                            <td><?php echo $m->person_name;?></td>
                            <td><?php echo $m->person_surname;?></td>
                            <td><?php echo $m->product_name;?></td>
                            <td>S/. <?php echo $m->debt_total;?></td>
                            <td>S/. <?php echo $m->debt_cancelled;?></td>
                            <td>S/. <?php echo $m->debt_total - $m->debt_cancelled;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" onclick="preguntarSiNo(<?php echo $m->id_debt;?>,<?php echo $m->debt_total - $m->debt_cancelled;?>,<?php echo $m->id_saleproduct;?>)">Cobrar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Producto</th>
                        <th>Monto Deuda Total</th>
                        <th>Monto Cancelado</th>
                        <th>Monto Por Cancelar</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <center><h4>Deudas en Alquileres</h4></center>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="example3" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Alquiler</th>
                        <th>Monto Deuda Total</th>
                        <th>Monto Cancelado</th>
                        <th>Monto Por Cancelar</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($debtrents as $m){
                        ?>
                        <tr>
                            <td><?php echo $m->person_name;?></td>
                            <td><?php echo $m->person_surname;?></td>
                            <td><?php echo $m->rent_name;?></td>
                            <td>S/. <?php echo $m->debtrent_total;?></td>
                            <td>S/. <?php echo $m->debtrent_cancelled;?></td>
                            <td>S/. <?php echo $m->debtrent_total - $m->debtrent_cancelled;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" onclick="preguntarSiNoR(<?php echo $m->id_debtrent;?>,<?php echo $m->debtrent_total - $m->debtrent_cancelled;?>,<?php echo $m->id_salerent;?>)">Cobrar</a></td>
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
        $("#example3").DataTable();
    });

    function preguntarSiNo(id_debt, debt_forpay,id_saleproduct){
        var mont = $('#monto_deuda').val();
        var rest = debt_forpay - mont;
        if(mont > 0){
            alertify.confirm('Cobrar deuda', '¿Esta pagar S/. ' + mont + ' de está deuda? Monto Restante de la Deuda: S/.' + rest,
                function(){ pagar(id_debt, debt_forpay,id_saleproduct, mont) }
                , function(){ alertify.error('Operacion Cancelada')});
        } else {
            alertify.error('No se ha ingresado un monto a pagar.');
        }

    }


    function preguntarSiNoR(id_debtrent, debt_forpay,id_salerent){
        var mont = $('#monto_deuda').val();
        var rest = debt_forpay - mont;
        if(mont > 0){
            alertify.confirm('Cobrar deuda', '¿Esta pagar S/. ' + mont + ' de está deuda? Monto Restante de la Deuda: S/.' + rest,
                function(){ pagarr(id_debtrent, debt_forpay,id_salerent, mont) }
                , function(){ alertify.error('Operacion Cancelada')});
        } else {
            alertify.error('No se ha ingresado un monto a pagar.');
        }

    }

    function pagar(id_debt, debt_forpay,id_saleproduct, mont) {
        var cadena = "id_debt=" + id_debt +
                    "&debt_forpay=" + debt_forpay +
                    "&id_saleproduct=" + id_saleproduct +
                    "&mont=" + mont;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Debt/payDebt",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Pago Realizado');
                    location.reload();
                } else {
                    alertify.error('No se pudo llevar acabo el alquiler');
                }
            }
        });
    }

    function pagarr(id_debtrent, debt_forpay,id_salerent, mont) {
        var cadena = "id_debtrent=" + id_debtrent +
                    "&debt_forpay=" + debt_forpay +
                    "&id_salerent=" + id_salerent +
                    "&mont=" + mont;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Debt/payDebtrent",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Pago Realizado');
                    location.reload();
                } else {
                    alertify.error('No se pudo llevar acabo el alquiler');
                }
            }
        });

    }
</script>

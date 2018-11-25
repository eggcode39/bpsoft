<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 24/11/2018
 * Time: 18:28
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!--Filtro Turnos-->
    <section class="content-header">
        <center><h4>Seleccionar Turno A Filtrar:</h4></center>
        <center>
            <select class="form-control" id="turno" onchange="sendturn()">
                <?php
                foreach ($info_turns as $it){
                    ?><option <?php echo ($turn->id_turn == $it->id_turn) ? 'selected' : '';?> value="<?php echo $it->id_turn;?>"><?php echo $it->turn_datestart . ' - ' . $it->turn_datefinish;?></option><?php
                }
                ?>
            </select>
        </center>
    </section>
    <!--Filtro Turnos-->
    <section class="content-header">
        <h1>
            Reporte
            <small>Reporte General del Turno</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Reporte</a></li>
            <li class="active">Reporte del Dia</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <center><h2>Reporte General Diarios</h2></center>
                <center><h3>Inicio Turno: <?php echo $turn->turn_datestart;?></h3></center>
                <center><h3>Fin Turno: <?php echo $turn->turn_datefinish;?></h3></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <center><h2>Reporte General Productos</h2></center>
                <?php

                //Calculo de Todo lo que es productos
                $ingresos_productos = 0;
                foreach ($products as $p){
                    $inventario_inicial = $this->report->initial_inventory($turn, $p->id_product);
                    $stock_added = $this->report->stockadded($turn, $p->id_product);
                    $products_selled = $this->report->products_selled($turn, $p->id_product);
                    $products_free = $this->report->products_free($turn, $p->id_product);
                    $products_debt = $this->report->products_debt($turn, $p->id_product);
                    $total_products = $products_selled + $products_free + $products_debt;
                    //Calcular Ganancia Por Producto
                    $total_per_product = $this->report->total_per_product($turn, $p->id_product);

                    $stock_final = $inventario_inicial + $stock_added - $total_products;
                    $stock_now = $this->report->total_products_now($p->id_product);
                    $ingresos_productos = $ingresos_productos + $total_per_product;
                    ?>
                    <table  class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th colspan="2">Nombre Producto</th>
                            <th colspan="4"><?php echo $p->product_name;?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Inventario Inicial</td>
                            <td>Agregado</td>
                            <td>Cantidad Vendida</td>
                            <td>Fiados</td>
                            <td>Invitados</td>
                            <td>Total Cantidad Saliente</td>
                            <td>Stock Final Del Dia</td>
                            <td>Stock Sistema</td>
                            <td>Total Ganancias Producto</td>
                        </tr>
                        <tr>
                            <td><?php echo $inventario_inicial ?? 0;?></td>
                            <td><?php echo $stock_added ?? 0;?></td>
                            <td><?php echo $products_selled ?? 0;?></td>
                            <td><?php echo $products_debt ?? 0;?></td>
                            <td><?php echo $products_free ?? 0;?></td>
                            <td><?php echo $total_products ?? 0;?></td>
                            <td><?php echo $stock_final ?? 0;?></td>
                            <td><?php echo $stock_now ?? 0;?></td>
                            <td>S/. <?php echo $total_per_product ?? 0;?></td>
                        </tr>
                        </tbody>
                    </table>
                    <?php
                }
                //Fin de Calculo Todo Lo Que Es Productos
                ?>
                <center><h4>Total Ingresos Ventas Productos: S/. <?php echo $ingresos_productos ?? 0;?></h4></center>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <center><h2>Reporte General Alquileres</h2></center>
                <?php
                $total_rent = $this->report->total_rent($turn);
                ?>
                <table  class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Descripcion:</th>
                        <th>Ganancia Total Alquileres</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Monto Total</td>
                        <td><bold>S/. <?php echo $total_rent ?? 0;?></bold></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <center><h2>Reporte General Pago Deudas</h2></center>
                <?php
                $total_debt = $this->report->total_debt($turn);
                ?>
                <table  class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Descripcion:</th>
                        <th>Ganancia Total Pago Deudas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Monto Total</td>
                        <td><bold>S/. <?php echo $total_debt ?? 0;?></bold></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <center><h2>Reporte General Pago Deudas de Alquiler</h2></center>
                <?php
                $total_debtrent = $this->report->total_debtrent($turn);
                ?>
                <table  class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Descripcion:</th>
                        <th>Ganancia Total Alquileres</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Monto Total</td>
                        <td><bold>S/. <?php echo $total_debtrent ?? 0;?></bold></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <center><h2>Egresos Del Turno</h2></center>
                <?php
                $expense = $this->report->all_expense($turn);
                $egresos = 0;
                ?>
                <table  class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Descripcion Egreso</th>
                        <th>Monto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($expense as $ex) {
                        ?>
                        <tr>
                            <td><?php echo $ex->expense_description;?></td>
                            <td>S/. <?php echo $ex->expense_mont;?></td>
                        </tr>
                        <?php
                        $egresos = $egresos + $ex->expense_mont;
                    }?>
                    </tbody>
                </table>
                <center><h3>Egresos Totales: S/. <?php echo $egresos ?? 0;?></h3></center>
            </div>
        </div>
        <br>
        <?php
        $balance_final = $ingresos_productos + $total_rent + $total_debt + $total_debtrent - $egresos;
        ?>
        <center><h2>SALDO TOTAL DEL DIA: S/. <?php echo $balance_final ?? 0;?></h2></center>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <center><button onclick="print()" class="btn btn-primary">Imprimir Reporte</button></center>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
        $("#example2").DataTable();
    });
    function sendturn(){
        id = $('#turno').val();
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Report/set_turn",
            data : cadena,
            success:function (r) {
                if(r==1){
                    location.reload();
                } else {
                    alertify.error('Error Al Mostrar Informacion');
                }
            }
        });
    }
</script>


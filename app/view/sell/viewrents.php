<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 12:44
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
                <center><h2>VISUALIZACIÓN DE ALQUILERES ACTIVOS</h2></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Hora Inicio</th>
                        <th>Hora Final</th>
                        <th style="width: 250px">Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($locations as $m){
                        $info = $this->sell->selectLocationstatus($m->id_location);
                        $estadol = '<a class="btn btn-grande btn-success btn-xs">LIBRE</a>';
                        $inicio = '-';
                        $fin = '-';
                        $accion = "<a class=\"btn btn-grande btn-success btn-xs\" type=\"button\" href=\"". _SERVER_ ."Sell/rent\">Alquilar</a>";

                        $fondo = "";

                        if(isset($info->salerent_finish)){
                            $horaactual = date('H:i:s');
                            $horafinal = $info->salerent_finish;

                            $horaactual = strtotime($horaactual);
                            $horafinal = strtotime($horafinal);

                            if($horaactual > $horafinal){
                                $fondo = "style=\"background-color: red;\"";
                            }

                        }

                        $estado = 0;
                        if(isset($info->location_status)){
                            $estado = $info->location_status;
                        }
                        if($estado == 1) {
                            $estadol = '<a class="btn btn-grande btn-danger btn-xs">EN USO</a>';
                            $inicio = $info->salerent_start;
                            $fin = $info->salerent_finish;
                            $accion = "<a class=\"btn btn-grande btn-warning btn-xs\" type=\"button\" onclick=\"preguntarSiNo(" . $info->id_salerent . "," . $m->id_location . "," . $info->id_locationrent. ")\">Finalizar</a>";
                        }

                        ?>
                        <tr <?php echo $fondo;?>>
                            <td class="texto-venta"><?php echo $m->location_name;?></td>
                            <td class="texto-venta"><?php echo $estadol;?></td>
                            <td class="texto-venta"><?php echo $inicio;?></td>
                            <td class="texto-venta"><?php echo $fin;?></td>
                            <td><?php echo $accion;?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Hora Inicio</th>
                        <th>Hora Final</th>
                        <th style="width: 250px">Acción</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>

    function preguntarSiNo(id_salerent, id_location, id_locationrent){
        alertify.confirm('Finalizar Alquiler','¿Seguro que desea finalizar está sesión?',
            function(){ finalizar(id_salerent, id_location, id_locationrent) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function finalizar(id_salerent, id_location, id_locationrent){
        var cadena = "id_salerent=" + id_salerent +
            "&id_location=" + id_location +
            "&id_locationrent=" + id_locationrent;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Sell/finishRent",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Alquiler Finalizado');
                    location.reload();
                } else {
                    alertify.error('Ocurrió un error');
                }
            }
        });
    }

</script>

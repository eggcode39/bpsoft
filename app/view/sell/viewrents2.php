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
        <?php
        $types = $this->inventory->listTypelocations();
        foreach ($types as $t){
            $location = $this->inventory->selectLocationstype($t->id_typelocation);
            $cant = count($location);
            if($cant != 0){
                ?>
                <div>
                    <center><h2><?php echo $t->typelocation_name;?></h2></center>
                    <?php
                    $col = 0;
                    foreach ($location as $m){
                        if($col == 0){
                            ?><div class="row"><?php
                        }
                        $col++;

                        $info = $this->sell->selectLocationstatus($m->id_location);
                        $estadol = '<a class="btn btn-grande btn-success btn-xs">LIBRE</a>';
                        $inicio = 'LIBRE';
                        $fin = '-';
                        $accion = "<a class=\"btn btn-grande btn-success btn-xs\" type=\"button\" href=\"". _SERVER_ ."Sell/rent\">Alquilar</a>";

                        $fondo = "style=\"background-color: green;\"";

                        $estado = 0;
                        if(isset($info->location_status)){
                            $estado = $info->location_status;
                        }
                        if($estado == 1) {
                            $estadol = '<a class="btn btn-grande btn-danger btn-xs">EN USO</a>';
                            $fondo = "style=\"background-color: #3c8dbc;\"";
                            //$inicio = $info->salerent_start;
                            $fin = 'Fin:' . $info->salerent_finish;
                            $accion = "<a class=\"btn btn-grande btn-warning btn-xs\" type=\"button\" onclick=\"preguntarSiNo(" . $info->id_salerent . "," . $m->id_location . "," . $info->id_locationrent. ")\">Finalizar</a>";
                        }



                        if(isset($info->salerent_finish)){
                            $horaactual = date('H:i:s');
                            $horafinal = $info->salerent_finish;

                            $horaactual = strtotime($horaactual);
                            $horaanticipada = strtotime( '+10 minute' ,$horaactual);
                            $horafinal = strtotime($horafinal);

                            if($horaactual > $horafinal){
                                $fondo = "style=\"background-color: red;\"";
                            } else if($horafinal < $horaanticipada){
                                $fondo = "style=\"background-color: yellow;\"";
                            }

                        }



                        ?>
                        <div class="col-lg-3" >
                            <div class="col-xs-11 boton-alquiler" <?php echo $fondo;?>>
                                <center><h3><?php echo $m->location_name;?></h3></center>
                                <center><h4><?php echo $fin;?></h4></center>
                                <center><?php echo $accion;?></center>
                            </div>
                        </div>
                        <?php
                        if($col == 4){
                            ?></div>
                            <br><?php
                            $col = 0;
                        }

                    }
                    ?>
                    </div>
                            <br>
                </div>
                <br><br>
                <?php
            }
        }
        ?>
    </section>
    <!-- /.content -->
</div>

<script>
    setTimeout('refrescar()', 5000);
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

    function refrescar() {
        location.reload();
    }

</script>

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
            <div class="col-lg-3" >
                <div class="col-xs-11" style="background-color: green; height: 150px;">
                    <center><h3>BILLAR</h3></center>
                    <center><h4>Hora Fin: 22:22:22</h4></center>
                </div>
            </div>
            <div class="col-lg-3" >
                <div class="col-xs-11" style="background-color: red; height: 150px; border-radius: 20px;">
                    <center><h3>BILLAR</h3></center>
                    <center><h4>Hora Fin: 22:22:22</h4></center>
                    <center><a class="btn btn-grande btn-success btn-xs" type="button" href="">Alquilar</a></center>
                </div>
            </div>
            <div class="col-lg-3" >
                <div class="col-xs-11" style="background-color: yellow; height: 100px;">
                    <center><h3>BILLAR</h3></center>
                    <center><h4>Hora Fin: 22:22:22</h4></center>
                </div>
            </div>
            <div class="col-lg-3" >
                <div class="col-xs-11" style="background-color: blue; height: 100px;">
                    <center><h3>BILLAR</h3></center>
                    <center><h4>Hora Fin: 22:22:22</h4></center>
                </div>
            </div>
        </div>

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
        //location.reload();
    }

</script>

<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 19/11/2018
 * Time: 11:57
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Turnos
            <small>Agregar Turnos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Turnos</a></li>
            <li><a href="#">Agregar</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Turn/seeAll" >Volver</a>
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
                        <h3 class="box-title">Turno a Agregar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Inicio</label>
                                <input type="date" class="form-control" id="turn_startdate" >
                                <input type="time" class="form-control" id="turn_starthour" >
                            </div>
                            <div class="form-group">
                                <label >Fin</label>
                                <input type="date" class="form-control" id="turn_finishdate" >
                                <input type="time" class="form-control" id="turn_finishhour" >
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Agregar Turno</button>
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
        var turn_startdate = $('#turn_startdate').val();
        var turn_starthour = $('#turn_starthour').val();

        var turn_finishdate = $('#turn_finishdate').val();
        var turn_finishhour = $('#turn_finishhour').val();

        if(turn_startdate == ""){
            alertify.error('El campo Fecha Inicio está vacío');
            $('#turn_startdate').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#turn_startdate').css('border','');
        }

        if(turn_starthour == ""){
            alertify.error('El campo Hora Inicio está vacío');
            $('#turn_starthour').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#turn_starthour').css('border','');
        }

        if(turn_finishdate == ""){
            alertify.error('El campo Fecha Fin está vacío');
            $('#turn_finishdate').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#turn_finishdate').css('border','');
        }

        if(turn_finishhour == ""){
            alertify.error('El campo Hora Fin está vacío');
            $('#turn_finishhour').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#turn_finishhour').css('border','');
        }

        if (valor == "correcto"){
            var turn_datestart = turn_startdate + ' ' + turn_starthour;
            var turn_datefinish = turn_finishdate + ' ' + turn_finishhour;
            var cadena = "turn_datestart=" + turn_datestart +
                "&turn_datefinish=" + turn_datefinish;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Turn/save",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Turn/seeAll';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>

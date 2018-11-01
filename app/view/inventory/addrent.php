<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 31/10/2018
 * Time: 19:01
 */?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Agregar Alquiler</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inventario</a></li>
            <li><a href="#">Agregar Alquiler</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Inventory/listRent" >Volver</a>
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
                        <h3 class="box-title">Alquiler a Agregar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre Alquiler</label>
                                <input type="text" class="form-control" id="rent_name" placeholder="Ingresar Nombre Alquiler...">
                            </div>
                            <div class="form-group">
                                <label >Descripcion Alquiler</label>
                                <input type="text" class="form-control" id="rent_description" placeholder="Ingresar Descripción Alquiler...">
                            </div>
                            <div class="form-group">
                                <label >Tiempo Alquiler(Minutos)</label>
                                <input type="text" class="form-control" id="rent_timeminutes" placeholder="Ingresar Tiempo Alquiler...">
                            </div>
                            <div class="form-group">
                                <label >Precio Total</label>
                                <input type="text" class="form-control" id="rent_cost" placeholder="Ingresar Precio Alquiler...">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Agregar Alquiler</button>
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
        var rent_name = $('#rent_name').val();
        var rent_description = $('#rent_description').val();
        var rent_timeminutes = $('#rent_timeminutes').val();
        var rent_cost = $('#rent_cost').val();

        if(rent_name == ""){
            alertify.error('El campo Nombre Alquiler está vacío');
            $('#rent_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#rent_name').css('border','');
        }

        if(rent_description == ""){
            alertify.error('El campo Descripcion Alquiler está vacío');
            $('#rent_description').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#rent_description').css('border','');
        }

        if(rent_timeminutes == ""){
            alertify.error('El campo Tiempo Alquiler(Minutos) está vacío');
            $('#rent_timeminutes').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#rent_timeminutes').css('border','');
        }

        if(rent_cost == ""){
            alertify.error('El campo Precio Total está vacío');
            $('#rent_cost').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#rent_cost').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "rent_name=" + rent_name +
                "&rent_description=" + rent_description +
                "&rent_timeminutes=" + rent_timeminutes +
                "&rent_cost=" + rent_cost;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Inventory/saveRent",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Inventory/listRent';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>

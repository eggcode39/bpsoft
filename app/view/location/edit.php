<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 25/11/2018
 * Time: 23:31
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Locacion
            <small>Editar Locacion</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Locacion</a></li>
            <li><a href="#">Editar Locacion</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Location/list" >Volver</a>
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
                        <h3 class="box-title">Locacion a Editar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre</label>
                                <input type="text" class="form-control" id="location_name" placeholder="Ingresar Locacion" value="<?php echo $location->location_name;?>">
                            </div>
                            <div class="form-group">
                                <label >Tipo de Locacion</label>
                                <select class="form-control" id="location_type" >
                                    <?php
                                    foreach ($type as $m){
                                        ?>
                                        <option <?php echo ($m->id_typelocation == $location->id_typelocation) ? 'selected' : '';?> value="<?php echo $m->id_typelocation?>"><?php echo $m->typelocation_name?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Editar Locacion</button>
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
        var id_location = <?php echo $location->id_location;?>;
        var location_name = $('#location_name').val();
        var location_type = $('#location_type').val();

        if(location_name == ""){
            alertify.error('El campo Nombre está vacío');
            $('#location_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#location_name').css('border','');
        }


        if (valor == "correcto"){
            var cadena = "id_location=" + id_location +
                "&location_name=" + location_name +
                "&location_type=" + location_type;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Location/save",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Location/all';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>

<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 31/10/2018
 * Time: 23:05
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Editar Objeto</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inventario</a></li>
            <li><a href="#">Editar Objeto</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Inventory/listObjects" >Volver</a>
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
                        <h3 class="box-title">Objeto a Agregar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre Objeto</label>
                                <input type="text" class="form-control" id="object_name" placeholder="Ingresar Nombre Objeto..." value="<?php echo $object->object_name;?>">
                            </div>
                            <div class="form-group">
                                <label >Descripcion Objeto</label>
                                <input type="text" class="form-control" id="object_description" placeholder="Ingresar Descripción Objeto..." value="<?php echo $object->object_description;?>">
                            </div>
                            <div class="form-group">
                                <label >Objeto Cantidad</label>
                                <input type="text" class="form-control" id="object_total" placeholder="Ingresar Cantidad Objeto..." value="<?php echo $object->object_total;?>">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Agregar Objeto</button>
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
        var id_object = value="<?php echo $object->id_object;?>";
        var object_name = $('#object_name').val();
        var object_description = $('#object_description').val();
        var object_total = $('#object_total').val();

        if(object_name == ""){
            alertify.error('El campo Nombre Objeto está vacío');
            $('#object_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#object_name').css('border','');
        }

        if(object_description == ""){
            alertify.error('El campo Descripcion Objeto está vacío');
            $('#object_description').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#object_description').css('border','');
        }

        if(object_total == ""){
            alertify.error('El campo Cantidad Objeto está vacío');
            $('#object_total').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#object_total').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "id_object=" + id_object +
                "&object_name=" + object_name +
                "&object_description=" + object_description +
                "&object_total=" + object_total;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Inventory/saveObject",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Inventory/listObjects';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>

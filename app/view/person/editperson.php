<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 13/11/2018
 * Time: 22:29
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Agregar Persona</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Persona</a></li>
            <li><a href="#">Agregar</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Inventory/listProducts" >Volver</a>
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
                        <h3 class="box-title">Persona a Agregar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombres Persona</label>
                                <input type="text" class="form-control" id="person_name" placeholder="Ingresar Nombres Persona..." value="<?php echo $list->person_name;?>">
                            </div>
                            <div class="form-group">
                                <label >Apellidos Persona</label>
                                <input type="text" class="form-control" id="person_surname" placeholder="Ingresar Apellidos Persona..." value="<?php echo $list->person_surname;?>">
                            </div>
                            <div class="form-group">
                                <label >DNI Persona</label>
                                <input type="text" class="form-control" id="person_dni" placeholder="Ingrese DNI Persona..." value="<?php echo $list->person_dni;?>">
                            </div>
                            <div class="form-group">
                                <label >Dirección Persona</label>
                                <input type="text" class="form-control" id="person_address" placeholder="Ingrese Dirección Persona..." value="<?php echo $list->person_address;?>">
                            </div>
                            <div class="form-group">
                                <label >Celular o Telefono Persona</label>
                                <input type="text" class="form-control" id="person_cellphone" placeholder="Ingrese Celular Persona..." value="<?php echo $list->person_cellphone;?>">
                            </div>
                            <div class="form-group">
                                <label >Genero Persona</label>
                                <select  id="person_genre">
                                    <option <?php echo ($list->person_genre == 'M') ? 'selected' : '';?> value="M">Masculino</option>
                                    <option <?php echo ($list->person_genre == 'F') ? 'selected' : '';?> value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Editar Persona</button>
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
        var id_person = <?php echo $list->id_person;?>;
        var valor = "correcto";
        var person_name = $('#person_name').val();
        var person_surname = $('#person_surname').val();
        var person_dni = $('#person_dni').val();
        var person_address = $('#person_address').val();
        var person_cellphone = $('#person_cellphone').val();
        var person_genre = $('#person_genre').val();

        if(person_name == ""){
            alertify.error('El campo Nombres Persona está vacío');
            $('#person_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_name').css('border','');
        }

        if(person_surname == ""){
            alertify.error('El campo Apellidos Persona está vacío');
            $('#person_surname').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_surname').css('border','');
        }

        if(person_dni == ""){
            alertify.error('El campo DNI Persona está vacío');
            $('#person_dni').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_dni').css('border','');
        }

        if(person_address == ""){
            alertify.error('El campo Direccion Persona está vacío');
            $('#person_address').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_address').css('border','');
        }

        if(person_cellphone == ""){
            alertify.error('El campo Celular o Telefono Persona está vacío');
            $('#person_cellphone').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_cellphone').css('border','');
        }

        if(person_genre == ""){
            alertify.error('El Género Persona está vacío');
            $('#person_genre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_genre').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "id_person=" + id_person +
                "&person_name=" + person_name +
                "&person_surname=" + person_surname +
                "&person_dni=" + person_dni +
                "&person_address=" + person_address +
                "&person_cellphone=" + person_cellphone +
                "&person_genre=" + person_genre;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Person/save",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Person/list';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>
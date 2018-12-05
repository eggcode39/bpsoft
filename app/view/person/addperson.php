<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 13/11/2018
 * Time: 22:08
 */?>

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
                                <input type="text" class="form-control" id="person_name" placeholder="Ingresar Nombres Persona...">
                            </div>
                            <div class="form-group">
                                <label >Apellidos Persona</label>
                                <input type="text" class="form-control" id="person_surname" placeholder="Ingresar Apellidos Persona...">
                            </div>
                            <div class="form-group">
                                <label >DNI Persona</label>
                                <input type="text" class="form-control" onkeypress="return valida(event)" id="person_dni" placeholder="Ingrese DNI Persona..." maxlength="8">
                            </div>
                            <div class="form-group">
                                <label >Dirección Persona</label>
                                <input type="text" class="form-control" id="person_address" placeholder="Ingrese Dirección Persona...">
                            </div>
                            <div class="form-group">
                                <label >Celular o Telefono Persona</label>
                                <input type="text" class="form-control" onkeypress="return valida(event)" id="person_cellphone" placeholder="Ingrese Celular o Telefono Persona...">
                            </div>
                            <div class="form-group">
                                <label >Genero Persona</label>
                                <select  id="person_genre">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Agregar Persona</button>
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
    function valida(e){
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla==8){
            return true;
        }
        // Patron de entrada, en este caso solo acepta numeros
        patron =/[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }

    function add() {
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
            var cadena = "person_name=" + person_name +
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

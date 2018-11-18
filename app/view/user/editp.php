<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 18/11/2018
 * Time: 14:50
 */
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuarios
            <small>Cambiar Contraseña</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Usuarios</a></li>
            <li><a href="#">Cambiar Contraseña</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>User/seeAll" >Volver</a>
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
                        <h3 class="box-title">Usuario a Modificar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre Usuario</label>
                                <input type="text" class="form-control" readonly id="user_nickname" placeholder="Ingresar Nombre Usuario..." value="<?php echo $useractive->user_nickname?>">
                            </div>
                            <div class="form-group">
                                <label >Contraseña</label>
                                <input type="password" class="form-control" id="user_password1" placeholder="Ingresar Contraseña...">
                            </div>
                            <div class="form-group">
                                <label >Repetir Contraseña</label>
                                <input type="password" class="form-control" id="user_password2" placeholder="Vuleva a Ingresar Contraseña...">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Agregar Usuario</button>
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
    $("#id_person").select2();


    function add() {
        var valor = "correcto";
        var id_user = <?php echo $useractive->id_user;?>;
        var user_password1 = $('#user_password1').val();
        var user_password12 = $('#user_password2').val();

        if(user_password1 == "" || user_password2 == ""){
            alertify.error('Uno de los campos Contraseña está vacío');
            $('#user_password1').css('border','solid red');
            $('#user_password2').css('border','solid red');
            valor = "incorrecto";
        } else {
            if(user_password1 != user_password12){
                alertify.error('Las Contraseñas no coinciden');
                $('#user_password1').css('border','solid red');
                $('#user_password2').css('border','solid red');
                valor = "incorrecto";

            } else {
                $('#user_password1').css('border','');
                $('#user_password2').css('border','');
            }
        }

        if (valor == "correcto"){
            var cadena = "id_user=" + id_user +
                "&user_password=" + user_password1 +
                "&password=si";
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/User/save",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>User/seeAll';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>

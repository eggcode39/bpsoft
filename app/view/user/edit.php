<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 18/11/2018
 * Time: 14:32
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuarios
            <small>Editar Usuarios</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Usuarios</a></li>
            <li><a href="#">Editar</a></li>
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
                        <h3 class="box-title">Usuario a Editar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre Usuario</label>
                                <input type="text" class="form-control" id="user_nickname" placeholder="Ingresar Nombre Usuario..." value="<?php echo $useractive->user_nickname;?>">
                            </div>
                            <div class="form-group">
                                <label> Rol Usuario</label>
                                <select id="id_role" class="form-control">
                                    <?php
                                    foreach ($roles as $r){
                                        ?>
                                        <option value="<?php echo $r->id_role;?>" <?php echo ($useractive->id_role == $r->id_role) ? 'selected' : '';?>><?php echo $r->role_name;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Persona a Designar Usuario</label>
                                <select class="form-control" id="id_person" multiple="multiple" data-placeholder="Selecciona Una Persona..." style="width: 100%;">
                                    <option selected value="<?php echo $useractive->id_person?>"><?php echo $useractive->person_name . ' ' . $useractive->person_surname; ?></option>
                                    <?php
                                    foreach ($person as $p){
                                        ?>
                                        <option value="<?php echo $p->id_person;?>"><?php echo $p->person_name . ' '. $p->person_surname;?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Editar Usuario</button>
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
        var id_person = $('#id_person').val();
        var id_user = <?php echo $useractive->id_user;?>;
        var id_role = $('#id_role').val();
        var user_nickname = $('#user_nickname').val();

        if(user_nickname == ""){
            alertify.error('El campo Nombre de Usuario está vacío');
            $('#user_nickname').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#user_nickname').css('border','');
        }


        if(id_person == null){
            alertify.error('¡NO SE HA SELECCIONADO UNA PERSONA PARA EL USUARIO!');
            $('#id_person').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#id_person').css('border','');
        }


        if (valor == "correcto"){
            var cadena = "id_person=" + id_person[0] +
                "&id_role=" + id_role +
                "&user_nickname=" + user_nickname +
                "&id_user=" + id_user;
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


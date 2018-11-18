<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 16/11/2018
 * Time: 8:37
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuarios
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Usuarios</a></li>
            <li class="active">Listar Usuarios</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Gestion de Productos</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>User/add" >Agregar Nuevo</a></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID Interno</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Nombre y Apellidos Usuario</th>
                        <th>¿Activo?</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $m){
                        $boton = "<a class=\"btn btn-chico btn-info btn-xs\" onclick=\"preguntarSiNo(". $m->id_user . ",1)\">Habilitar</a>";
                        if ($m->user_status == 1){
                            $boton = "<a class=\"btn btn-chico btn-danger btn-xs\" onclick=\"preguntarSiNo(". $m->id_user . ",0)\">Deshabilitar</a>";
                        }
                        ?>
                        <tr>
                            <td><?php echo $m->id_user;?></td>
                            <td><?php echo $m->user_nickname;?></td>
                            <td><?php echo $m->role_name;?></td>
                            <td><?php echo $m->person_name . ' ' . $m->person_surname;?></td>
                            <td><?php echo ($m->user_status == 1) ? 'SI' : 'NO';?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>User/edit/<?php echo $m->id_user;?>">Editar</a><a class="btn btn-chico-especial btn-success btn-xs" type="button" href="<?php echo _SERVER_;?>User/modifyPassword/<?php echo $m->id_user;?>">Cambiar Contraseña</a><?php echo $boton;?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID Interno</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Nombre y Apellidos Usuario</th>
                        <th>¿Activo?</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
        $("#example2").DataTable();
    });

    function preguntarSiNo(id,status){
        alertify.confirm('Cambiar Estado', '¿Esta seguro que desea cambiar el estado de este usuario?',
            function(){ eliminar(id,status) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id, status){
        var cadena = "id=" + id +
                    "&status=" + status ;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/User/deleteUser",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Estado Cambiado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>

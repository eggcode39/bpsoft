<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 13/11/2018
 * Time: 21:50
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Personas
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Personas</a></li>
            <li class="active">Listar Personas</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Gestion de Personas</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Person/addPerson" >Agregar Nuevo</a></center>
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
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Direccion</th>
                        <th>Celular</th>
                        <th>Género</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $m){
                        ?>
                        <tr>
                            <td><?php echo $m->id_person;?></td>
                            <td><?php echo $m->person_name;?></td>
                            <td><?php echo $m->person_surname;?></td>
                            <td><?php echo $m->person_dni;?></td>
                            <td><?php echo $m->person_address;?></td>
                            <td><?php echo $m->person_cellphone;?></td>
                            <td><?php echo $m->person_genre;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>Person/editPerson/<?php echo $m->id_person;?>">Editar</a><a class="btn btn-chico btn-danger btn-xs" onclick="preguntarSiNo(<?php echo $m->id_person;?>)">Eliminar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID Interno</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Direccion</th>
                        <th>Celular</th>
                        <th>Género</th>
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

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id){
        var cadena = "id_person=" + id;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Person/deletePerson",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Persona Eliminada');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>

<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 25/11/2018
 * Time: 1:37
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Egresos
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Egresos</a></li>
            <li class="active">Listar Egresos</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Gestion de Egresos</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Expense/add" >Agregar Nuevo</a></center>
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
                        <th>Monto</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $g = "<a class=\"btn btn-chico btn-danger btn-xs\" onclick=\"preguntarSiNo(1)\">Eliminar</a>";
                    foreach ($expenses as $m){
                        ?>
                        <tr>
                            <td><?php echo $m->id_expense;?></td>
                            <td><?php echo $m->expense_mont;?></td>
                            <td><?php echo $m->expense_description;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>Expense/edit/<?php echo $m->id_expense;?>">Editar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID Interno</th>
                        <th>Monto</th>
                        <th>Descripción</th>
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
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este ogreso?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id){
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Expense/delete",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Egreso Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>



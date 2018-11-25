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
            Inventario
            <small>Agregar Egreso</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Egreso</a></li>
            <li><a href="#">Agregar Egreso</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Expense/list" >Volver</a>
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
                        <h3 class="box-title">Egreso a Agregar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Monto del Egreso</label>
                                <input type="text" class="form-control" id="expense_mont" placeholder="Ingresar Monto" value="<?php echo $expense->expense_mont;?>">
                            </div>
                            <div class="form-group">
                                <label >Descripcion</label>
                                <input type="text" class="form-control" id="expense_description" placeholder="Ingresar Descripción..." value="<?php echo $expense->expense_description;?>">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Editar Egreso</button>
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
        var id_expense = <?php echo $expense->id_expense;?>;
        var expense_mont = $('#expense_mont').val();
        var expense_description = $('#expense_description').val();

        if(expense_mont == ""){
            alertify.error('El campo Monto está vacío');
            $('#expense_mont').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#expense_mont').css('border','');
        }

        if(expense_description == ""){
            alertify.error('El campo Descripcion está vacío');
            $('#expense_description').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#expense_description').css('border','');
        }


        if (valor == "correcto"){
            var cadena = "id_expense=" + id_expense +
                "&expense_mont=" + expense_mont +
                "&expense_description=" + expense_description;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Expense/save",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Expense/all';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>

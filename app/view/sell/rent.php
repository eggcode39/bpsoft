<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:36
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Venta
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Venta</a></li>
            <li class="active">Realizar Venta Rapida</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <center><h2>ALQUILERES</h2></center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-5">
                <label style="font-size: 18px;padding-right: 10px;">Cliente a Vender: </label>
                <input style="font-size: 18px;padding-left: 8px;width: 320px;" type="text" value="0000000 - Anonymus Young" id="name_person" readonly>
                <input type="text" id="id_persona" style="display: none" value="2">
            </div>
            <div class="col-xs-3">
                <label style="font-size: 18px"> Cantidad a Vender: </label>
                <input  style="font-size: 18px;width: 65px;padding-left: 10px;" type="number" value="1" id="product_sale">
            </div>
            <div class="col-xs-2">
                <select id="type_sell" class="form-control">
                    <option value="YES">VENTA AL CONTADO</option>
                    <option value="NO">FIADO</option>
                    <?php
                    $type_user = $this->crypt->decrypt($_COOKIE['role_name'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role_name'],_PASS_);
                    if($type_user == 'Admin'){
                        echo '<option value="FREE">LA CASA INVITA</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-2">
                <select id="id_location" class="form-control">
                    <?php
                    foreach ($locations as $location){
                        ?>
                        <option value="<?php echo $location->id_location;?>"><?php echo $location->location_name;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-8">
                <center><h2>Alquileres</h2></center>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Alquiler</th>
                        <th>Descripción</th>
                        <th>Tiempo (Minutos)</th>
                        <th>Precio</th>
                        <th style="width: 250px">Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($rents as $rent){
                        ?>
                        <tr>
                            <td class="texto-venta"><?php echo $rent->rent_name;?></td>
                            <td class="texto-venta"><?php echo $rent->rent_description;?></td>
                            <td class="texto-venta"><?php echo $rent->rent_timeminutes;?></td>
                            <td class="texto-venta">S/. <?php echo $rent->rent_cost;?></td>
                            <td><a class="btn btn-grande btn-success btn-xs" type="button" onclick="preguntarSiNoR(<?php echo $rent->id_rent;?>, '<?php echo $rent->rent_name;?>',<?php echo $rent->rent_timeminutes;?>,<?php echo $rent->rent_cost;?>)">Alquilar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Tipo de Venta</th>
                        <th>Precio</th>
                        <th style="width: 250px">Acción</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-lg-4">
                <center><h2>Clientes</h2></center>
                <table id="example3" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($people as $person){
                        $espacio = ' ';
                        ?>
                        <tr>
                            <td><?php echo $person->person_name;?></td>
                            <td><?php echo $person->person_surname;?></td>
                            <td><?php echo $person->person_dni;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" onclick="agregarPersona('<?php echo $person->person_name . $espacio . $person->person_surname;?>', '<?php echo $person->person_dni;?>', <?php echo $person->id_person;?>)">Agregar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
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
    var id_person = $("#id_persona").val();
    var nameperson = 'Anonymus';
    $(function () {
        $("#example2").DataTable();
        $("#example3").DataTable();
    });

    function agregarPersona(nombres, dni, id) {
        $("#name_person").val(dni + ' - ' + nombres);
        $("#id_persona").val(id);
        id_person = id;
        nameperson = nombres;
    }

    function preguntarSiNoR(id_rent,nameproduct,timeminutes,price){
        var tipoventa = $('#type_sell').val();
        var unid_sale = $("#product_sale").val();
        var id_persona = id_person;
        var totalprice = price * unid_sale;
        var minutes_to_rent = timeminutes * unid_sale;
        if(tipoventa == 'YES'){
            alertify.confirm('Realizar Alquiler', '¿Esta seguro de que desea alquilar '+ nameproduct +' por '+ minutes_to_rent+' minutos por un precio de S/. ' + totalprice +' soles a ' + nameperson + '?',
                function(){ vender(id_rent, id_persona, minutes_to_rent, totalprice) }
                , function(){ alertify.error('Operacion Cancelada')});
        } else if(tipoventa == 'NO'){
            if(id_person == 2){
                alertify.error('ERROR: NO SE PUEDE FIAR A USUARIO ANONYMUS');
            } else {
                alertify.confirm('Fiar Alquiler', '¿Esta seguro de que desea fiar el alquiler de  '+ nameproduct +' por '+ minutes_to_rent+' minutos por un precio de S/. ' + totalprice +' soles a ' + nameperson + '?',
                    function(){ fiar(id_rent, id_persona, minutes_to_rent, totalprice) }
                    , function(){ alertify.error('Operacion Cancelada')});
            }
        } else{
            alertify.confirm('LA CASA INVITA', '¿Esta seguro de que desea alquilar '+ nameproduct +' por '+ minutes_to_rent+' minutos GRATIS a ' + nameperson + '?',
                function(){ regalar(id_rent, id_persona, minutes_to_rent, totalprice) }
                , function(){ alertify.error('Operacion Cancelada')});
        }
    }

    function vender(id_rent, id_persona, minutes_to_rent, totalprice){
        var id_location = $("#id_location").val();
        var cadena = "id_rent=" + id_rent +
                    "&id_person=" + id_persona +
                    "&minutes_to_rent=" + minutes_to_rent +
                    "&totalprice=" + totalprice +
                    "&id_location=" + id_location;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Sell/sellRent",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Alquiler Realizado');
                    location.reload();
                } else {
                    alertify.error('No se pudo llevar acabo el alquiler');
                }
            }
        });
    }
    function fiar(id_rent, id_persona, minutes_to_rent, totalprice){
        var id_location = $("#id_location").val();
        var tipoventa = "FIAR";
        var cadena = "id_rent=" + id_rent +
            "&id_person=" + id_persona +
            "&minutes_to_rent=" + minutes_to_rent +
            "&totalprice=" + totalprice +
            "&type_sell=" + tipoventa +
            "&id_location=" + id_location +
            "&type_sell=" + tipoventa;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Sell/sellRent",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Alquiler Realizado');
                    location.reload();
                } else {
                    alertify.error('No se pudo llevar acabo el alquiler');
                }
            }
        });
    }
    function regalar(id_rent, id_persona, minutes_to_rent, totalprice){
        var id_location = $("#id_location").val();
        var tipoventa = "REGALAR";
        var cadena = "id_rent=" + id_rent +
            "&id_person=" + id_persona +
            "&minutes_to_rent=" + minutes_to_rent +
            "&totalprice=" + totalprice +
            "&type_sell=" + tipoventa +
            "&id_location=" + id_location ;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Sell/sellRent",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Alquiler Realizado');
                    location.reload();
                } else {
                    alertify.error('No se pudo llevar acabo el alquiler');
                }
            }
        });
    }


</script>


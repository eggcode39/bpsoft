
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inicio
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">
                <center><h2>Bienvenido al Sistema de Administracion</h2></center>
                <center><h4>Su rol de Usuario es: <?php echo $this->crypt->decrypt($_COOKIE['role_name'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role_name'],_PASS_);?></h4></center>
            </div>
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

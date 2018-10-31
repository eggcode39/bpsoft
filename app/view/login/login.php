<!DOCTYPE html>
<html lang="en">
<head>
    <title>BPSoft - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo _SERVER_;?>styles/pool.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _LOGIN_STYLES_;?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _LOGIN_STYLES_;?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _LOGIN_STYLES_;?>css/main.css">
    <!--===============================================================================================-->

    <!-- Alertify -->
    <script src="<?php echo _STYLES_;?>alertifyjs/alertify.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo _STYLES_;?>alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="<?php echo _STYLES_;?>alertifyjs/css/themes/default.css">

</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?php echo _SERVER_ . _LOGIN_STYLES_;?>images/img-01.png" alt="IMG">
            </div>

            <div class="login100-form validate-form">
					<span class="login100-form-title">
						BillarSoft - Login
					</span>
                <div class="wrap-input100 validate-input" data-validate = "Usuario Requerido">
                    <input class="input100" type="text" name="user" id="user" placeholder="Usuario">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Contraseña Requerida">
                    <input class="input100" type="password" name="pass" id="pass" placeholder="Contraseña">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" onclick="loginsistema()">
                        Iniciar Sesión
                    </button>
                </div>

                <div class="text-center p-t-12">

                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="#">

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo _SERVER_ . _LOGIN_STYLES_;?>vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })

    function loginsistema() {
        var usuario = $('#user').val();
        var contrasenha = $('#pass').val();
        var cadena = "user_nickname=" + usuario +
            "&user_password=" + contrasenha;
        $.ajax({
            type: "POST",
            url: "<?php echo _SERVER_;?>api/Login/singIn",
            data: cadena,
            success:function (r) {
                if(r==1){
                    //alert('Logueado');
                    alertify.success('Ingreso exitoso');
                    //location.href = "<?php echo _SERVER_;?>"
                    location.reload();
                } else {
                    //alert('no pe');
                    alertify.error('Usuario y/o Contraseña Incorrectos');
                }

            }
        });
    }
</script>
<!--===============================================================================================-->
<script src="<?php echo _SERVER_ . _LOGIN_STYLES_;?>js/main.js"></script>

</body>
</html>
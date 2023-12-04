<!DOCTYPE html>
<html lang="es">

<head>
	<title>Shield</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="vistas/img/login/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/bower_components/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/bower_components/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/bower_components/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/bower_components/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/bower_components/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/bower_components/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/bower_components/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vistas/css/login/util.css">
	<link rel="stylesheet" type="text/css" href="vistas/css/login/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('vistas/img/login/fondo.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form method="post" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-53">
						<img src="vistas/img/login/icons/SHIELD-WEB_edited.webp"> Distribuidores
					</span>
					<!--
					<a href="#" class="btn-face m-b-20">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>

					<a href="#" class="btn-google m-b-20">
						<img src="images/icons/icon-google.png" alt="GOOGLE">
						Google
					</a>-->
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Usuario
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Escribe el nombre de usuario">
						<input class="input100" type="text" name="username" required>
						<span class="focus-input100"></span>
					</div>

					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Contraseña
						</span>

						<a href="correo-recuperar-contrasena" class="txt2 bo1 m-l-5">
							Olvidaste tu contraseña?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Escribe la contraseña">
						<input class="input100" type="password" name="pass" required>
						<span class="focus-input100"></span>
					</div>
					<!--<div class="p-t-13 p-b-9">
						<div class="g-recaptcha" data-sitekey="6LfDyOskAAAAABg5zkCg2D0BNg2FkzcrPo0sq_Js"></div>
					</div>-->
					<?php

					$login = new ControladorUsuarios();
					$login->ctrIngresoUsuario();

					?>
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>
					<div class="w-full text-center p-t-55">
						<span class="txt2">
							¿Quieres ser un distribuidor?
						</span>

						<a href="formulario-solicitantes" class="txt2 bo1">
							Regístrate ahora
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="vistas/bower_components/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vistas/bower_components/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vistas/bower_components/bootstrap/js/popper.js"></script>
	<script src="vistas/bower_components/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vistas/bower_components/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vistas/bower_components/daterangepicker/moment.min.js"></script>
	<script src="vistas/bower_components/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vistas/bower_components/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<!--<script src="vistas/js/main.js"></script>-->

</body>

</html>
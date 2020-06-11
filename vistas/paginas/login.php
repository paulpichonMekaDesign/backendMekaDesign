<?php session_start();

	// si hay sesion iniciada no permitimos que el usuario pueda volver al login
  if (isset($_SESSION["validarSesionMD"])) {
    
      header("Location: inicio");

  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MekaDesign | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/pluginsAdminLte/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/plugins/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="login"><b>Meka</b>Design</a> -->
    <img src="vistas/imagenes/logo-MekaDesing.png" alt="Meka Design Logo" width="100%">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingresar para iniciar sesión</p>

      <form id="loginFormulario" method="post">
      <div class="form-group">
        <input type="text" name="correo" id="correo" class="form-control" placeholder="Correo electronico">
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
      </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
			<?php

				$ingresar = new Ingresar();
				$ingresar -> ingresarSesion();

			?>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="vistas/plugins/pluginsAdminLte/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/pluginsAdminLte/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/plugins/dist/js/adminlte.min.js"></script>
<!-- jQueryValidate -->
<script src="vistas/plugins/pluginsAdminLte/jquery-validation/jquery.validate.js"></script>
<!-- VALIDAR LOGIN -->
<script src="vistas/js/validarLogin.js"></script>

</body>
</html>

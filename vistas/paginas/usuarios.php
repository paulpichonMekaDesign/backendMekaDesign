<?php session_start();

if (!$_SESSION["validarSesionMD"]) {
     
     header("Location: login");

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Usuarios | MekaDesign</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/pluginsAdminLte/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/pluginsAdminLte/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/pluginsAdminLte/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/plugins/dist/css/adminlte.min.css">
  <!-- sweetalert 2-->
	<link rel="stylesheet" type="text/css" href="vistas/plugins/sweetalert2/sweetalert2.css"/>
	<script src="vistas/plugins/sweetalert2/sweetalert2.js"></script>
  <!-- Estilos propios -->
  <link rel="stylesheet" href="vistas/css/estilosUsuarios.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="sidebar-mini sidebar-collapse">
<div class="wrapper">
  <!-- Menu Nav Superior -->
  <?php include "modulos/menuNavBar.php"; ?>

  <!-- Menu ASIDE -->
  <?php include "modulos/menu.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
               <div class="card-header">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#agregarUsuario">Agregar usuario</button>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                    <table id="tablaUsuarios" class="display nowrap table table-hover table-striped table-bordered">
                    <thead class="text-center">
                    <tr>
                         <th>No</th>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Correo</th>
                         <th>Foto de perfil</th>
                         <th>Cargo</th>
                         <th>Fecha de registro</th>
                         <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php 
                         
						$resistroUsuario = new Usuarios();
						$resistroUsuario -> leerRegistrosUsuarioControlador();

                        ?>
                    </tbody>
                    </table>
               </div>
               <!-- /.card-body -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <!-- Menu lateral derecho cerrar sesion  -->
  <?php include "modulos/menuDerecho.php"; ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Modal Agregar Usuarios -->
<?php include "modalCrearUsuarios.php"; ?>

<!-- modal editar usuarios -->
<!-- Modal -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Información Usuarios</h5>
			</div>
			<div class="modal-body">
				<form id="formularioEditarUsuario" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="edtNombreUsuario">Cambiar nombre:</label>
						<input type="text" class="form-control" id="edtNombreUsuario" name="edtNombreUsuario" placeholder="Nombre de usuario">
					</div>
					<div class="form-group">
						<label for="edtApellidoUsuario">Cambiar apellido:</label>
						<input type="text" class="form-control" id="edtApellidoUsuario" name="edtApellidoUsuario" placeholder="Apellido de usuario">
					</div>
					<div class="form-group">
						<label for="edtCorreoUsuario">Cambiar correo electronico</label>
						<input type="text" class="form-control" id="edtCorreoUsuario" name="edtCorreoUsuario" placeholder="Correo de usuario">
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="edtPassword">Cambiar contraseña</label>
								<input type="password" class="form-control" id="edtPassword" name="edtPassword" placeholder="Contraseña del usuario">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="edtConfirmar_contraseña">Repetir Contraseña</label>
								<input type="password" class="form-control" id="edtConfirmar_contraseña" name="edtConfirmar_contraseña" placeholder="Repetir Contraseña del usuario">
							</div>
						</div>
					</div>

					<div class="row mb-4 mt-4 d-flex justify-content-center">
						<div class="col-md-6 contenedorInputFile" style="display: none;">
							<div class="form-group">
								<label for="edtImagen">Seleccione una nueva imagen de perfil</label>
								<input type="file" class="form-control-file" id="edtImagen">
								<input type="hidden" class="form-control-file" id="antiguaImagen" name="antiguaImagen">
							</div>
						</div>

						<div class="col-md-6">
							<div class="previsualizarImagenPerfilEdt text-center">
								
							</div>
							<!-- <img src="vistas/imagenes/usuarios/default-user-img.jpg" alt="" width="150px">  -->
						</div>
					</div>

					<div class="col-xl-6 col-lg-6 col-md-12">
						<div class="form-group">
							<label for="edtTipoUsuario">Cambiar el tipo de usuario:</label>
							<select class="form-control" id="edtTipoUsuario" name="edtTipoUsuario">
								<option value=""> - Seleccione una opción - </option>
								<option value="1">Administrador</option>
								<option value="0">Auxiliar</option>
							</select>
						</div>
					</div>
					<input type="hidden" id="editarInput" name="editarInput" value="">
					<div class="modal-footer text-center">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Cancelar</button>
						<button type="submit" class="btn btn-primary" id="guardarCambios">Guardar Cambios</button>
					</div>

					<?php
						
						$guardarCambios = new Usuarios();
						$guardarCambios -> guardarCambiosCtr();

					?>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- jQuery -->
 <script src="vistas/plugins/pluginsAdminLte/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/pluginsAdminLte/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="vistas/plugins/pluginsAdminLte/datatables/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/pluginsAdminLte/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vistas/plugins/pluginsAdminLte/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/pluginsAdminLte/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/plugins/dist/js/adminlte.min.js"></script>
<!-- jQueryValidate -->
<script src="vistas/plugins/pluginsAdminLte/jquery-validation/jquery.validate.js"></script>
<!-- VALIDAR FORMULARIO CREAR USUARIO -->
<script src="vistas/js/formularioAgregarUsuario.js"></script>
<!-- VALIDAR FORMULARIO EDITAR USUARIO -->
<script src="vistas/js/editarFormularioAgregarUsuario.js"></script>
<!-- archivo js usuarios -->
<script src="vistas/js/usuarios.js"></script>

<!-- page script -->
<script>
  $(function () {
    $('#tablaUsuarios').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "scrollX": true,
      "language":
      {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
      }
    });
  });
</script>
</body>
</html>

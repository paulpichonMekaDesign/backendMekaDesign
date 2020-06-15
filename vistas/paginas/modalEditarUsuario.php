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
<!-- Modal -->
<div class="modal fade" id="eliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
			</div>
			<div class="modal-body">
				<form id="formularioEliminarUsuario" method="post">
					<input type="hidden" id="eliminarUsuarioId" name="eliminarUsuarioId">
					<input type="hidden" id="imagenEliminarUsuario" name="imagenEliminarUsuario">
					<div class="mt-3 mb-3 text-center">
						<p><h5>¿Desea eliminar este usuario?</h5></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Cancelar</button>
						<button type="button" class="btn btn-danger  confirmarEliminarUsuario">Eliminar usuario</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
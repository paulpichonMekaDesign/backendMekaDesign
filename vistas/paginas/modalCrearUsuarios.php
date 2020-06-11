<!-- Modal -->
<div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
               <form id="formularioAgregarUsuario" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                         <label for="nombreUsuario">Nombre:</label>
                         <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Nombre de usuario">
                    </div>
                    <div class="form-group">
                         <label for="apellidoUsuario">Apellido:</label>
                         <input type="text" class="form-control" id="apellidoUsuario" name="apellidoUsuario" placeholder="Apellido de usuario">
                    </div>
                    <div class="form-group">
                         <label for="correoUsuario">Correo electronico</label>
                         <input type="text" class="form-control" id="correoUsuario" name="correoUsuario" placeholder="Correo de usuario">
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="password">Contraseña</label>
                                   <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña del usuario">
                              </div>
                         </div>

                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="confirmar_contraseña">Repetir Contraseña</label>
                                   <input type="password" class="form-control" id="confirmar_contraseña" name="confirmar_contraseña" placeholder="Repetir Contraseña del usuario">
                              </div>
                         </div>
                    </div>

                    <div class="row mb-4 mt-4">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="imagenPerfil">Seleccione una imagen de perfil</label>
                                   <input type="file" class="form-control-file" id="imagenPerfil" name="imagenPerfil">
                              </div>
                         </div>

                         <div class="col-md-6">
                              <div class="previsualizarImagenPerfil text-center">

                              </div>
                                   <!-- <img src="vistas/imagenes/usuarios/default-user-img.jpg" alt="" width="150px"> -->
                         </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                         <div class="form-group">
                              <label for="tipoUsuario">Tipo de usuario:</label>
                              <select class="form-control" id="tipoUsuario" name="tipoUsuario">
                                   <option value=""> - Seleccione una opción - </option>
                                   <option value="1">Administrador</option>
                                   <option value="0">Asistente</option>
                              </select>
                         </div>
                    </div>
                    <div class="modal-footer text-center">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                         <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                    </div>

                    <?php
                    
                         $crearUsuario = new Usuarios();
                         $crearUsuario -> crearUsuario();

                    ?>

               </form>
          </div>
    </div>
  </div>
</div>
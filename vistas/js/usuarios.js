//variables
//cargar imagen
const cargarImagen = document.getElementById('imagen');
// Editar informacion usuario
const idEdtUsuario = document.querySelector(".btnEditar");
// cambiar imagen de usuario
const cambiarImagenPrevisualizacion = document.getElementById('edtImagen');


// console.log($(".previsualizarImagenPerfil").html());
//para cuanodo no haya imagenes en el contenedor de la imagen
if ($(".previsualizarImagenPerfil").html() == 0) {
     
     $(".previsualizarImagenPerfil").append('<h6 class="text-center tituloCargarImagen">Cargar una imagen para poder visualizarla</h6>');
     
} else {
     
     $(".tituloCargarImagen").remove();

}


/**************event listenrs**************/
//cuando se carga una imagen
cargarImagen.addEventListener('change', function(e) {

     $(".tituloCargarImagen").remove();

     // se optiene la imagen desde el evento (e)
     let imagen = this.files[0];
     // peso de la imagen
     imagenSize = imagen.size;
     // validación de la imagen
     if (Number(imagenSize) > 2000000 ) {

          $(".previsualizarImagenPerfil").before(`<div class="alert alert-danger text-center alertaImgPesada" role="alert">
                                                       La imagen debe tener un peso maximo de 2MB
                                                  </div>`);

          setTimeout(() => {
               $(".alertaImgPesada").remove();
          }, 3500);

     } else{

          $(".alertaImgPesada").remove();

     }
     // tipo de imagen
     imagenTipo = imagen.type;

     if ( imagenTipo == 'image/jpeg' || imagenTipo == 'image/png') {
       
          $(".alertaImgTipo").remove();
          
     }else{

          $(".previsualizarImagenPerfil").before(`<div class="alert alert-danger text-center alertaImgTipo" role="alert">
                                                       ¡La imagen debe tener formato JPG ó PNG!
                                                  </div>`);

          setTimeout(() => {
               $(".alertaImgTipo").remove();
          }, 3500);

     }

     if (Number(imagenSize) < 2000000 && imagenTipo == 'image/jpeg' || imagenTipo == 'image/png') {
          
          let datos = new FormData();
          
          datos.append('imagen', imagen);

          $.ajax({
               url: "vistas/ajax/usuariosAjax.php",
               method: "POST",
               data:datos,
               cache: false,
               contentType: false,
               processData: false,
               success: function(respuesta){
                    
                    if (respuesta == 0) {
                         
                         $(".previsualizarImagenPerfil").before(`<div class="alert alert-danger text-center alertaImgTipo" role="alert">
                                                       ¡La imagen debe ser de 400px * 400px como minimo!
                                                  </div>`);

                    } else {

                         $(".previsualizarImagenPerfil").html('<img src="'+respuesta.slice(6)+'" alt="" width="150px">');
                         // console.log(respuesta);
                         
                         
                    }
                    
               }
          });
          
     }

});


// Traer la informacion de usuario
 $(".btnEditar").click(function(){

     let idEditar = $(this).attr("id");
      
     let idUsuario = new FormData();

     idUsuario.append("idEditar", idEditar);

     $.ajax({
     url:"vistas/ajax/usuariosAjax.php",
     method: "POST",
     data: idUsuario,
     cache: false,
     contentType: false,
     processData: false,
     dataType: "json",
     success: function(respuesta){

          // console.log(respuesta);
          $("#editarInput").val(respuesta["hash"]);
          $("#edtNombreUsuario").val(respuesta["nombre_usuario"]);
          $("#edtApellidoUsuario").val(respuesta["apellido_usuario"]);
          $("#edtCorreoUsuario").val(respuesta["correo"]);
          $("#edtPassword").val("*****");
          $("#edtConfirmar_contraseña").val("*****");
          // base64_encode -> btoa()
          $("#antiguaImagen").val(btoa(respuesta["foto_perfil"]));
          $(".previsualizarImagenPerfilEdt").html(`<span class="editarImagenPerfil" title="Cambiar Imagen"><i class="fas fa-edit"></i></span>
                                                  <img class="imagenActualUsuario" src=" ${ respuesta["foto_perfil"] } " alt="" width="200px" height="200px">`);
          $("#edtTipoUsuario").val(respuesta["tipo_usuario"]);
          
     }
     });
     
});

//cambiar imagen de usuario
$(document).on('click', ".editarImagenPerfil", function(){

     $(this).remove();
     $(".imagenActualUsuario").remove();
     $(".contenedorInputFile").show();

     //atributos al input files
     $("#edtImagen").attr("name","nuevaImagen");
     $("#edtImagen").attr("require", true);


     cambiarImagenPrevisualizacion.addEventListener('change', function(e) {

          // se optiene la imagen desde el evento (e)
          let imagen = this.files[0];
          // peso de la imagen
          imagenSize = imagen.size;
          // validación de la imagen
          if (Number(imagenSize) > 2000000 ) {
     
               $(".previsualizarImagenPerfilEdt").before(`<div class="alert alert-danger text-center alertaImgPesada" role="alert">
                                                            La imagen debe tener un peso maximo de 2MB
                                                       </div>`);
     
               setTimeout(() => {
                    $(".alertaImgPesada").remove();
               }, 3500);
     
          } else{
     
               $(".alertaImgPesada").remove();
     
          }
          // tipo de imagen
          imagenTipo = imagen.type;
     
          if ( imagenTipo == 'image/jpeg' || imagenTipo == 'image/png') {
            
               $(".alertaImgTipo").remove();
               
          }else{
     
               $(".previsualizarImagenPerfilEdt").before(`<div class="alert alert-danger text-center alertaImgTipo" role="alert">
                                                            ¡La imagen debe tener formato JPG ó PNG!
                                                       </div>`);
     
               setTimeout(() => {
                    $(".alertaImgTipo").remove();
               }, 3500);
     
          }
     
          if (Number(imagenSize) < 2000000 && imagenTipo == 'image/jpeg' || imagenTipo == 'image/png') {
               
               let datos = new FormData();
               
               datos.append('imagen', imagen);
     
               $.ajax({
                    url: "vistas/ajax/usuariosAjax.php",
                    method: "POST",
                    data:datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){
                         
                         if (respuesta == 0) {
                              
                              $(".previsualizarImagenPerfilEdt").before(`<div class="alert alert-danger text-center alertaImgTipo" role="alert">
                                                            ¡La imagen debe ser de 400px * 400px como minimo!
                                                       </div>`);
     
                         } else {
     
                              $(".previsualizarImagenPerfilEdt").html('<img src="'+respuesta.slice(6)+'" alt="" width="150px">');
                              // console.log(respuesta);
                              
                              
                         }
                         
                    }
               });
               
          }
     
     });

})

//traer informacion para Eliminar usuarios
$(".btnEliminar").click(function(){

     let idEditar = $(this).attr("id");
      
     let idUsuario = new FormData();

     idUsuario.append("idEditar", idEditar);

     $.ajax({
          url:"vistas/ajax/usuariosAjax.php",
          method: "POST",
          data: idUsuario,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(respuesta){

               // console.log(respuesta);
               $("#eliminarUsuarioId").val(respuesta["hash"]);
               $("#imagenEliminarUsuario").val(btoa(respuesta["foto_perfil"]));

          }

     });

});

//funcion para eliminar usuarios
 $(".confirmarEliminarUsuario").click(function(){

     let idEliminar = $(this).parent().parent().children("#eliminarUsuarioId").val();
     let imagenPerfil = $(this).parent().parent().children("#imagenEliminarUsuario").val();

     const datosEliminar = new FormData();

     datosEliminar.append("idEliminar", idEliminar);
     datosEliminar.append("imagenPerfil", imagenPerfil);

     $.ajax({
          url:"vistas/ajax/usuariosAjax.php",
          method: "POST",
          data: datosEliminar,
          cache: false,
          contentType: false,
          processData: false,
          success: function(respuesta){

               console.log( respuesta );
               if (respuesta == "ok") {
                    
                    const Toast = Swal.mixin({
                         toast: true,
                         position: 'center',
                         showConfirmButton: true,
                         timer: 5000,
                         timerProgressBar: true,
                         onOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                         }
                    })
                    
                    Toast.fire({
                         icon: 'success',
                         title: 'Correcto',
                         text: 'Registro eliminado'
                    }).then(function()
                    {
                         document.location.href='usuarios';
                    })
                    
               }else{
     
                    const Toast = Swal.mixin({
                         toast: true,
                         position: 'center',
                         showConfirmButton: true,
                         timer: 5000,
                         timerProgressBar: true,
                         onOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                         }
                    })
                    
                    Toast.fire({
                         icon: 'error',
                         title: 'Error',
                         text: 'Hubo un error, favor de intentar más tarde'
                    }).then(function()
                    {
                         document.location.href='usuarios';
                    })
     
               }
               

          }
     });
     

 });
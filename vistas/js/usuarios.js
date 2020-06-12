//variables
//cargar imagen
const cargarImagen = document.getElementById('imagen');

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



<?php

class Usuarios{

     public function cargarImagenVisualizar($datosControlador){

          // print_r();
          list($ancho, $alto) = getimagesize($datosControlador);
          
          if ($ancho < 400 || $alto < 400) {
               
               echo 0;

          }else {
               
               $aleatorio = mt_rand(100, 999);

               $ruta = "../../vistas/imagenes/usuarios/TEMP/temporal".$aleatorio.".jpg";

               $origen = imagecreatefromjpeg($datosControlador);

               $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 500, "height" => 500]);

               imagejpeg($destino, $ruta);

               echo $ruta;
               
          }

     }

     public function crearUsuario(){

          if (isset($_POST["nombreUsuario"])) {
               //variables
               
               if (isset($_FILES["imagen"]["tmp_name"]) && !empty($_FILES["imagen"]["tmp_name"]) ) {

                    //imagen
                    $imagen = $_FILES["imagen"]["tmp_name"];

                    $borrarTemp = glob("vistas/imagenes/usuarios/TEMP/*"); 

                    foreach ($borrarTemp as $key => $imagenTemp) {
                         
                         unlink($imagenTemp);

                    }
                    $aleatorio = mt_rand(100, 999);
                    
                    $ruta = "vistas/imagenes/usuarios/imgPerfil/imagenPerfil".$aleatorio.".jpg";

                    $origen = imagecreatefromjpeg($imagen);

                    $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 500, "height" => 500]);

                    imagejpeg($origen, $ruta);

               }else{
                    //imagen
                    $ruta = "vistas/imagenes/usuarios/default-user-img.jpg";

               }

               $nombreUsuario = $_POST["nombreUsuario"];
               $apellidoUsuario = $_POST["apellidoUsuario"];
               $correoUsuario = $_POST["correoUsuario"];
               $password = $_POST["password"];
               $tipoUsuario = $_POST["tipoUsuario"];
               //hash que servira como id para poder editar e identificar al usuario
               $hash = md5(random_int(0, 1000));

     
               // encriptar la contraseña del usuario agregado
               $passwordEncriptada = crypt($password , '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

               if (preg_match('/^([a-zA-ZáéíóúÁÉÍÓÚñÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ]+[\s]*)+$/', $nombreUsuario) &&
               preg_match('/^([a-zA-ZáéíóúÁÉÍÓÚñÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ]+[\s]*)+$/', $apellidoUsuario) &&
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $correoUsuario)) {
                    
                    $datosControlador = array("nombreUsuario" => $nombreUsuario,
                                              "apellidoUsuario" => $apellidoUsuario,
                                              "correoUsuario" => $correoUsuario,
                                              "password" => $passwordEncriptada,
                                              "imagenRuta" => $ruta,
                                              "tipoUsuario" => $tipoUsuario,
                                              "hash" => $hash
                                             );
                    
                    $respuesta = UsuariosModelo::registrarUsuario($datosControlador);

                    if ($respuesta == "ok") {
               
                         echo "<script>
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
                                   title: 'Registro Exitoso',
                                   text: 'El usuario ha sido registrado'
                              }).then(function()
                              {
                                   document.location.href='usuarios';
                              })
                         </script>";
                         
                    }else {
                         
                         echo "<script>
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
                                        text: 'Algo salio mal, favor de intentar mas tarde'
                                   }).then(function()
                                   {
                                        document.location.href='usuarios';
                                   })
                              </script>";
                         
                    }



               }else{

                    echo '<div class="alert alert-danger" role="alert">
                              ¡Algo salio mal favor de intentar más tarde!
                         </div>';

               } 

          }

     }

     //funcion para traer los registros
     public function leerRegistrosUsuarioControlador(){

          // API MEKA DESIGN DEBE TENER CREDENCIALES PARA PODER USAR LA API
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "http://mekadesign-api.mx/usuarios",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
               "Authorization: Basic YTJhYTA3YWFmYXJ0d2V0c2RBRDUyMzU2RkVER2VrQlpzSDEuVUcuRkNwUjVCNGZxS1lTT2hBN3N2dEZXOmEyYWEwN2FhZmFydHdldHNkQUQ1MjM1NkZFREdlcVhHZHhEZGFuSGtWeElNdFNsRDJ6MDVGZUE2TlRsVw==",
          "Content-Type: application/x-www-form-urlencoded"
          ),
          ));

          $response = curl_exec($curl);
          
          curl_close($curl);
          
          $status = json_decode($response, true);

          if ($status["status"] === 200) {
               
               //******* Convertir el json que viene de la API a un ARRAY   **********
               
               $jsonDecode = json_decode($response, true);
               
               // comprobar que el usuario exista en la base de datos de la API
               foreach ($jsonDecode["detalle"] as $key => $value) {

                    $fecha = $value["fecha_registro"];
                    $timestamp = strtotime($fecha);
                    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    $dia = date('d', $timestamp);
                    $mes = date('m', $timestamp) - 1;
                    $year = date('Y', $timestamp);
                    // $hora = date('H:i', $timestamp);
                    $fecha = "$dia / " . $meses[$mes] . " / $year";

                    // tipo de usuario
                    if ($value["tipo_usuario"] == 1) {
                         $tipoUsuario = "Administrador";
                    }else {                      
                         $tipoUsuario = "Auxiliar";                       
                    }

                    echo '<tr>
                              <td class="align-middle">'.$value["id_usuario"].'</td>
                              <td class="align-middle">'.$value["nombre_usuario"].'</td>
                              <td class="align-middle">'.$value["apellido_usuario"].'</td>
                              <td class="align-middle">'.$value["correo"].'</td>
                              <td class="align-middle"><img src="'.$value["foto_perfil"].'" alt="" width="40px"></td>
                              <td class="align-middle">'.$tipoUsuario.'</td>
                              <td class="align-middle">'.$fecha.'</td>
                              <td class="align-middle">
                              <a class="btnAcciones btnEditar mr-2" href="" title="Editar" data-toggle="modal" data-target="#modalEditarUsuario" id="'.$value["hash"].'"><i class="fas fa-edit"></i></a>
                              <a class="btnAcciones btnEliminar" href="" title="Eliminar" data-toggle="modal" data-target="#eliminarUsuario" id="'.$value["hash"].'"><i class="fas fa-trash-alt"></i></a>
                              </td> 

                         </tr>';
                    
               }
               
               
          }else {
               
               echo '<div class="alert alert-danger text-center mt-3" role="alert">
                         Algo salio mal al procesar la solicitud
                    </div>';

          }

     }

     // traer informacion para mostrarla en el formulario de editar usuario
     public function informacionUsuarioEdtCtr($datosControlador){

          $respuesta = UsuariosModelo::informacionUsuarioEdtMdl($datosControlador);

          echo $respuesta;

     }

     public function guardarCambiosCtr(){

          if (isset($_POST["editarInput"])) {


               if (isset($_FILES["nuevaImagen"]["tmp_name"]) && !empty($_FILES["nuevaImagen"]["tmp_name"])) {
                    
                    //imagen
                    $imagen = $_FILES["nuevaImagen"]["tmp_name"];

                    $borrarTemp = glob("vistas/imagenes/usuarios/TEMP/*"); 

                    foreach ($borrarTemp as $key => $imagenTemp) {
                         
                         unlink($imagenTemp);

                    }
                    $aleatorio = mt_rand(100, 999);
                    
                    $ruta = "vistas/imagenes/usuarios/imgPerfil/imagenPerfil".$aleatorio.".jpg";

                    $origen = imagecreatefromjpeg($imagen);

                    $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 500, "height" => 500]);

                    imagejpeg($origen, $ruta);

                    //Borrar imagen
                    $imagenAntigua = base64_decode($_POST["antiguaImagen"]);

                    if ($imagenAntigua !== "vistas/imagenes/usuarios/default-user-img.jpg") {
                          //borrar imagen antigua
                          unlink(base64_decode($_POST["antiguaImagen"]));
                    }


               }else {
                    
                    $ruta = base64_decode($_POST["antiguaImagen"]);
                    
               }

               $idEditar = $_POST["editarInput"];
               $nombre = $_POST["edtNombreUsuario"];
               $apellido = $_POST["edtApellidoUsuario"];
               $correo = $_POST["edtCorreoUsuario"];
               $password = $_POST["edtPassword"];
               $tipo = $_POST["edtTipoUsuario"];

               $datosControlador = array("idEditar" => $idEditar,
                                             "nombre" => $nombre,
                                             "apellido" => $apellido,
                                             "correo" => $correo,
                                             "password" => $password,
                                             "rutaImagen" => $ruta,
                                             "tipo" => $tipo,
                                        );

               $respuesta = UsuariosModelo::editarInfoUsuariosMdl($datosControlador);
   
               if ($respuesta == "ok") {
                    
                    echo "<script>
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
                                        text: 'Registro actualizado'
                                   }).then(function()
                                   {
                                        document.location.href='usuarios';
                                   })
                              </script>";
                    
               }else{

                    echo "<script>
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
                         </script>";

               }

          }

     }

     //Eliminar usuarios
     public function eliminarUsuarioCtr($datosControlador){
          
          $respuesta = UsuariosModelo::eliminarUsuarioMdl($datosControlador);

          //Borrar imagen
          $borrarImagen = base64_decode($datosControlador["imagenPerfil"]);

          if ($borrarImagen !== "vistas/imagenes/usuarios/default-user-img.jpg") {
                //borrar imagen antigua
                unlink("../../".$borrarImagen);
          }
          
          echo $respuesta;

     }

}

<?php

require_once "modelos/usuarios.modelo.php";

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
           
               if (isset($_FILES["imagenPerfil"]["tmp_name"])) {
                    //imagen
                    $imagen = $_FILES["imagenPerfil"]["tmp_name"];

                    $borrarTemp = glob("vistas/imagenes/usuarios/TEMP/*"); 

                    foreach ($borrarTemp as $key => $imagenTemp) {
                         
                         unlink($imagenTemp);

                    }
                    $aleatorio = mt_rand(100, 999);
                    
                    $ruta = "vistas/imagenes/usuarios/imgPerfil/imagenPerfil".$aleatorio.".jpg";
                    
                    $origen = imagecreatefromjpeg($imagen);

                    $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 500, "height" => 500]);

                    imagejpeg($destino, $ruta);

               }else{

                    //imagen
                    $ruta = "vistas/imagenes/usuarios/default-user-img.jpg";

               }

               $nombreUsuario = $_POST["nombreUsuario"];
               $apellidoUsuario = $_POST["apellidoUsuario"];
               $correoUsuario = $_POST["correoUsuario"];
               $password = $_POST["password"];
               $tipoUsuario = $_POST["tipoUsuario"];

               if (preg_match('/^([a-zA-ZáéíóúÁÉÍÓÚñÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ]+[\s]*)+$/', $nombreUsuario) &&
               preg_match('/^([a-zA-ZáéíóúÁÉÍÓÚñÑ][a-zA-ZáéíóúÁÉÍÓÚñÑ]+[\s]*)+$/', $apellidoUsuario) &&
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $correoUsuario)) {
                    
                    $datosControlador = array("nombreUsuario" => $nombreUsuario,
                                              "apellidoUsuario" => $apellidoUsuario,
                                              "correoUsuario" => $correoUsuario,
                                              "password" => $password,
                                              "imagenPerfil" => $ruta,
                                              "tipoUsuario" => $tipoUsuario
                                             );
                    
                    $respuesta = UsuariosModelo::registrarUsuario($datosControlador);

                    echo $respuesta;


               }else{

                    echo '<div class="alert alert-danger" role="alert">
                              ¡Algo salio mal favor de intentar más tarde!
                         </div>';

               } 

          }

     }

}
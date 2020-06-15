<?php

class UsuariosModelo{

     public function registrarUsuario($datosModelo){

          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "http://mekadesign-api.mx/usuarios",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => 'nombre='.$datosModelo['nombreUsuario'].'&apellido='.$datosModelo['apellidoUsuario'].'&correo='.$datosModelo['correoUsuario'].'&password='.$datosModelo['password'].'&imagenRuta='.$datosModelo['imagenRuta'].'&tipoUsuario='.$datosModelo['tipoUsuario'].'&hash='.$datosModelo['hash'].'',
            CURLOPT_HTTPHEADER => array(
               "Authorization: Basic YTJhYTA3YWFmYXJ0d2V0c2RBRDUyMzU2RkVER2VrQlpzSDEuVUcuRkNwUjVCNGZxS1lTT2hBN3N2dEZXOmEyYWEwN2FhZmFydHdldHNkQUQ1MjM1NkZFREdlcVhHZHhEZGFuSGtWeElNdFNsRDJ6MDVGZUE2TlRsVw==",
              "Content-Type: application/x-www-form-urlencoded"
            ),
          ));
          
          $response = curl_exec($curl);
          
          $status = json_decode($response, true);
          
          // print_r($status);
          
          if ($status["status"] === 200) {
               
               return "ok";
               
          }else {
               
               return "error";
               
          }
          
          curl_close($curl);

     }

     //traer informacion de API para mostrar en la edicion
     public function informacionUsuarioEdtMdl($datosModelo){


          $curl = curl_init();

          curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://mekadesign-api.mx/usuarios/'.$datosModelo.'',
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
          
          $respuesta = json_decode($response, true);
          
          // print_r($respuesta["detalle"]);
          // $respuesta = json_decode($response, true);

          // print_r($respuesta);
          // print_r($respuesta["detalle"][0]);
          
          if ($respuesta["status"] == 200) {

               echo json_encode($respuesta["detalle"][0]);
               
          }else{

               echo '<div class="alert alert-danger text-center mt-3" role="alert">
                         Algo salio mal, favor de intentar más tarde.
                    </div>';

          }


     }

     // editar informacion de usuarios 
     public function editarInfoUsuariosMdl($datosModelo){

          $curl = curl_init();

          
          curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://mekadesign-api.mx/usuarios/'.$datosModelo["idEditar"].'',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "PUT",
          CURLOPT_POSTFIELDS => 'nombre='.$datosModelo["nombre"].'&apellido='.$datosModelo["apellido"].'&correo='.$datosModelo["correo"].'&password='.$datosModelo["password"].'&imagenRuta='.$datosModelo["rutaImagen"].'&tipoUsuario='.$datosModelo["tipo"].'',
          CURLOPT_HTTPHEADER => array(
          "Authorization: Basic YTJhYTA3YWFmYXJ0d2V0c2RBRDUyMzU2RkVER2VrQlpzSDEuVUcuRkNwUjVCNGZxS1lTT2hBN3N2dEZXOmEyYWEwN2FhZmFydHdldHNkQUQ1MjM1NkZFREdlcVhHZHhEZGFuSGtWeElNdFNsRDJ6MDVGZUE2TlRsVw==",
          "Content-Type: application/x-www-form-urlencoded"
          ),
          ));

          $response = curl_exec($curl);

          curl_close($curl);
          
          $respuesta = json_decode($response, true);

          // print_r($respuesta["status"]);
          if ($respuesta["status"] == 200) {
               
               return "ok";

          }else{

               return "error";

          }

     }

     //Eliminar usuarios
     public function eliminarUsuarioMdl($datosModelo){

          $curl = curl_init();

          curl_setopt_array($curl, array(
               CURLOPT_URL => 'http://mekadesign-api.mx/usuarios/'.$datosModelo["idEliminar"].'',
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "DELETE",
               // CURLOPT_POSTFIELDS => "nombre=Paul&apellido=Eljefe&correo=jefedefejes@nuevo.com&password=12345&imagenRuta=vistas/imagenes/usuarios/default-user-img.jpg&tipoUsuario=1",
               CURLOPT_HTTPHEADER => array(
                    "Authorization: Basic YTJhYTA3YWFmYXJ0d2V0c2RBRDUyMzU2RkVER2VrQlpzSDEuVUcuRkNwUjVCNGZxS1lTT2hBN3N2dEZXOmEyYWEwN2FhZmFydHdldHNkQUQ1MjM1NkZFREdlcVhHZHhEZGFuSGtWeElNdFNsRDJ6MDVGZUE2TlRsVw==",
                    "Content-Type: application/x-www-form-urlencoded"
               ),
          ));

          $response = curl_exec($curl);

          curl_close($curl);
          
          $respuesta = json_decode($response, true);

          // print_r($respuesta["status"]);
          if ($respuesta["status"] == 200) {
               
               return "ok";

          }else{

               return "error";

          }

     }

}
<?php

class UsuariosModelo{

     public function registrarUsuario($datosModelo){

          $curl = curl_init();


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
            CURLOPT_POSTFIELDS => 'nombre='.$datosModelo['nombreUsuario'].'&apellido='.$datosModelo['apellidoUsuario'].'&correo='.$datosModelo['correoUsuario'].'&password='.$datosModelo['password'].'&imagenRuta='.$datosModelo['imagenRuta'].'&tipoUsuario='.$datosModelo['tipoUsuario'].'',
            CURLOPT_HTTPHEADER => array(
              "Authorization: Basic YTJhYTA3YWFmYXJ0d2V0c2RBRDUyMzU2RkVER2VwSnl3TU4vVC9oc2R0c2ZSVUxDbzE1MUR6VXBSZ0IyOmEyYWEwN2FhZmFydHdldHNkQUQ1MjM1NkZFREdlci5Ma2Z4MzBONlRiYVZ0ZVN0TmRtV0lVNEwuL0VucQ==",
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

}
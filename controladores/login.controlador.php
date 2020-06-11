<?php 

class Ingresar{

     public function ingresarSesion(){

          if (isset($_POST["correo"])) {

               $correo = $_POST["correo"];
               $password = $_POST["password"];

               if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $correo)) {
                    
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
               "Authorization: Basic YTJhYTA3YWFmYXJ0d2V0c2RBRDUyMzU2RkVER2VwSnl3TU4vVC9oc2R0c2ZSVUxDbzE1MUR6VXBSZ0IyOmEyYWEwN2FhZmFydHdldHNkQUQ1MjM1NkZFREdlci5Ma2Z4MzBONlRiYVZ0ZVN0TmRtV0lVNEwuL0VucQ==",
               "Content-Type: application/x-www-form-urlencoded"
               ),
               ));

               $response = curl_exec($curl);
               
               curl_close($curl);
               
               $status = json_decode($response, true);

               if ($status["status"] === 200) {
                    
                    //******* Convertir el json que viene de la API a un ARRAY   **********

                    // var_dump(json_decode($json));
                    // var_dump(json_decode($response, true));
                    
                    $jsonDecode = json_decode($response, true);
                    // print_r($jsonDecode["detalle"]);
                    // print_r($jsonDecode);

                    // comprobar que el usuario exista en la base de datos de la API
                    foreach ($jsonDecode["detalle"] as $key => $value) {

                         $mensaje = "";
                         
                         if ($correo == $value["correo"] && $password == $value["password"]) {
                         
                              //inicio de sesion del usuario
                              session_start();

                              $_SESSION["validarSesionMD"] = true;
                              $_SESSION["nombreUsuario"] = $value["nombre_usuario"];
                              $_SESSION["apellidoUsuario"] = $value["apellido_usuario"];
                              $_SESSION["correoUsuario"] = $value["correo"];

                              header("Location: inicio");
                         
                         break;
                         }else{

                              $mensaje = '<div class="alert alert-danger text-center mt-3" role="alert">
                                             El usuario o contraseña son incorrectos
                                        </div>';
                         }
                         
                    }
                    
                    echo $mensaje;
                    
               }else {
                    
                    echo '<div class="alert alert-danger text-center mt-3" role="alert">
                              Algo salio mal al procesar la solicitud
                         </div>';

               }


     

               }else{

                    echo '<div class="alert alert-danger" role="alert">
                              ¡Algo salio mal, por favor intente más tarde!
                         </div>';

               }

          }

     }

}
<?php

class Rutas{

     public function rutasControlador(){

          if (isset($_GET["pagina"])) {
               
               $enlace = $_GET["pagina"];

               if ( $enlace == "inicio" ||
                    $enlace == "login" ||
                    $enlace == "suscriptores" ||
                    $enlace == "close" ||
                    $enlace == "usuarios"
                    ) {
                    
                    $pagina = "vistas/paginas/".$enlace.".php";

               }else {
                    
                    $pagina = "vistas/paginas/error404.php";
                    
               }

          }else {
               
               $pagina = "vistas/paginas/inicio.php";
               
          }

          include $pagina;

     }

}
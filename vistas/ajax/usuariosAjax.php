<?php

require_once "../../controladores/usuarios.controlador.php";
// require_once "../../modelos/usuarios.modelo.php";

class Ajax{

     // cargar imagen para previsualizar
     public $imagen;

     public function cargarImagen(){

          $datos = $this->imagen;

          $respuesta = Usuarios::cargarImagenVisualizar($datos);

          return $respuesta;

     }

}

// Objetos
if (isset($_FILES["imagenPerfil"]["tmp_name"])) {
     
     $a = new Ajax();
     $a -> imagen = $_FILES["imagenPerfil"]["tmp_name"];
     $a -> cargarImagen();
}
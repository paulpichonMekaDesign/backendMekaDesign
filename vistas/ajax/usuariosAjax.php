<?php

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

class Ajax{

     // cargar imagen para previsualizar
     public $imagen;

     public function cargarImagen(){

          $datos = $this->imagen;

          $respuesta = Usuarios::cargarImagenVisualizar($datos);

          return $respuesta;

     }

     //traer informacion para editar a usuario
     public $idEditar;

     public function informacionUsuarioEdt(){

          $datosAjax = $this->idEditar;

          $respuesta = Usuarios::informacionUsuarioEdtCtr($datosAjax);

          echo $respuesta;

     }

     //Eliminar usuario
     public $idEliminar;
     public $imagenPerfil;

     public function eliminarUsuarioAjax(){

          $datosAjax = array( "idEliminar" => $this->idEliminar,
                              "imagenPerfil" => $this->imagenPerfil
                         );

          $respuesta = Usuarios::eliminarUsuarioCtr($datosAjax);

          return $respuesta;

     }


}

// Objetos
// cargar imagen
if (isset($_FILES["imagen"]["tmp_name"])) {
     
     $a = new Ajax();
     $a -> imagen = $_FILES["imagen"]["tmp_name"];
     $a -> cargarImagen();
}

//cargar informacion de usuario para editar
if (isset($_POST["idEditar"])) {
     
     $b = new Ajax();
     $b -> idEditar = $_POST["idEditar"];
     $b -> informacionUsuarioEdt();
}

//eliminar usuarios
if (isset($_POST["idEliminar"])) {
     
     $c = new Ajax();
     $c -> idEliminar = $_POST["idEliminar"];
     $c -> imagenPerfil = $_POST["imagenPerfil"];
     $c -> eliminarUsuarioAjax();

}


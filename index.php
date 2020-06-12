<?php

require_once "controladores/template.controlador.php";
require_once "controladores/rutas.controlador.php";
require_once "controladores/login.controlador.php";
require_once "controladores/usuarios.controlador.php";

//modelos
require_once "modelos/usuarios.modelo.php";


$template = new Template();
$template -> templateControlador();


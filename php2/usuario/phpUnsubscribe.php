<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$usuario = $sesion->getUsuario();

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$r = $modelo->desactivar($usuario->getLogin());

$bd->closeConexion();
$sesion->setUsuario($nuevoUsuario);
header("Location:phplogout.php?r=$r");   
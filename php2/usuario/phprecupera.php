<?php
require '../require/comun.php';
$id = Leer::post("id");
$login = Leer::post("login");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->cambiarClave($login, $id);
if ($r <= 0) {
    $bd->closeConexion();
    header("Location:index.php");
    exit();
}
$usuario = $modelo->get($login);
$clave = Leer::post("clave");
$claveConfirmada = Leer::post("claveConfirmada");
//validar php
/* if($clave !=  $claveconfirmada){
  header ("Location: index.php");
  exit();
  } */
$nuevoUsuario = new Usuario($login, $clave, $usuario->getNombre(), $usuario->getApellidos(), $usuario->getEmail());
$bd = new BaseDatos();
$r = $modelo->editConClave($nuevoUsuario, $usuario->getLogin(), $usuario->getClave());
$bd->closeConexion();
header("Location:../index.php");   
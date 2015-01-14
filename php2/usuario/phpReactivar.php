<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$usuario = $sesion->getUsuario();

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$usuario->setIsactivo(1);
$modelo->edit($usuario, $usuario->getLogin());

if($usuario->getIsroot()==1){
    $bd->closeConexion();
    header("Location:viewRoot.php");
    exit();
}
$bd->closeConexion();
header("Location:../indexConectado.php");   
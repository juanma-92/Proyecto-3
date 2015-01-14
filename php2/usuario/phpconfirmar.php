<?php
require '../require/comun.php';
header('Content-Type: text/plain');
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$login = Leer::get("login");
$cod = Leer::get("codigo");

$objeto = $modelo->get($login);

$codigo = md5($objeto->getEmail().Configuracion::PEZARANA.$objeto->getLogin());

echo $codigo."   ".$cod;
if($cod != $codigo){
    echo 'Algo ha salido mal';
    exit();
}else{
    $objeto->setIsactivo(1);
    $modelo->edit($objeto, $objeto->getLogin());
    $sesion->setUsuario($objeto);
    $usuario = $modelo->get($login);
    $modelo->fechalogin($usuario);
    header("Location:../indexConectado.php");
}
echo ($modelo->get($login)->getNombre() == null ? "Nombre de usuario valido" : "Nombre de usuario en uso");
<?php
require '../../require/comun.php';
$bd = new BaseDatos();
$sesion->autentificado("../viewlogin.php");
$u = $sesion->getUsuario();
if($u->getIsroot()!=1){
    header("Location:../phplogout.php");   
    exit();
};

$id = Leer::get("login");
$consultaSql = "delete from producto where id=:id";
$parametros["id"] = $id;
$r = $bd->setConsulta($consultaSql, $parametros);
header("Location: viewProductos.php?r=$r");
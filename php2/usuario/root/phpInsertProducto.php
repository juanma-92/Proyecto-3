<?php
require '../../require/comun.php';
$bd = new BaseDatos();
$sesion->autentificado("../viewlogin.php");
$u = $sesion->getUsuario();
if($u->getIsroot()!=1){
    header("Location:../phplogout.php");   
    exit();
};
$nombre = Leer::post("nombre");
$precio = Leer::post("precio");
$consultaSql = "insert into producto values (null, :nombre, :precio);";
$parametros["nombre"] = $nombre;
$parametros["precio"] = $precio;
$r = $bd->setConsulta($consultaSql, $parametros);
header("Location: viewProductos.php?r=$r");
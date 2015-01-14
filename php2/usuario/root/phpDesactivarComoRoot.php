<?php
require '../../require/comun.php';
$sesion->autentificado("../viewlogin.php");
if(!$sesion->isAdministrador()){
    header("Location:../phplogout.php");
    exit();
}

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$login = Leer::get("login");

$r = $modelo->desactivarComoRoot($login);

$bd->closeConexion();
header("Location:viewUsuarios.php?r=$r");   
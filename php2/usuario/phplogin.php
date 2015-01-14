<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->login($login, $clave);
if($usuario == false ){
    $usuarioInactivo = $modelo->loginInactivo($login, $clave);
    if($usuarioInactivo == false){
        $sesion->cerrar();
        $bd->closeConexion();
        header("Location:viewlogin.php?error=Login incorrecto o contraseña incorrecta");
    }else{
        $sesion->setUsuario($usuarioInactivo);
        header("Location:viewReactivar.php");
    }
} else {
    $sesion->setUsuario($usuario);
    $modelo->fechalogin($usuario);
    if($usuario->getIsroot()==1){
        header("Location:viewRoot.php");
        exit();
    }
    $bd->closeConexion();
    header("Location:../indexConectado.php");
}
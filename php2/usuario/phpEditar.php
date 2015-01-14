<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$usuario = $sesion->getUsuario();
$login = Leer::post("login");
$clave = Leer::post("clave");
$claveNueva = Leer::post("claveNueva");
$claveConfirmada = Leer::post("claveConfirmada");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$passRoot = Leer::post("passRoot");
$r = 0;
$nuevoUsuario = new Usuario($login, $claveNueva, $nombre, $apellidos, $email);
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$cambioDeClave = strlen($claveNueva)> 0 && $claveNueva==$claveConfirmada ;
$cambioDeCorreo = $email!=$usuario->getEmail();

if($cambioDeClave){ //modificado
    $claveV = sha1($clave);
    if($claveV==$usuario->getClave()){
        $r = $modelo->editConClave($nuevoUsuario, $usuario->getLogin(), $usuario->getClave());
    }else{
        $r = 0;
    }
} else {
    if($usuario->getLogin()==$login && $usuario->getNombre()==$nombre && $usuario->getApellidos()==$apellidos && $usuario->getEmail()==$email){
        $r =1;
    }else{
        $r = $modelo->editSinClave($nuevoUsuario, $usuario->getLogin());
    }
}

if($cambioDeCorreo && $r>0){
    $id = md5($email.Configuracion::PEZARANA.$login);    
    $enlace = "Click aqui: <a href='".Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id")."'>Validar cuenta</a>";       
    $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "alta en web", $enlace, Configuracion::CLAVEGMAIL);
}

$root = $usuario->getIsroot();
if ($r != 1){
    if($root==1){
        header("Location:viewRoot.php?r=0");
        exit();
    }else{
        header("Location:../indexConectado.php?r=0");
        exit();
    }
}


if (isset($_POST['root'])){ //nuevo
    if($passRoot==Configuracion::passRoot){
        $modelo->hacerRoot($nuevoUsuario->getLogin());
        $nuevoUsuario->setIsroot(1);
        $nuevoUsuario->setRol(1);
        $bd->closeConexion();
        $sesion->setUsuario($nuevoUsuario);
        header("Location:viewRoot.php?r=1");
        exit();
    }else{
        header("Location:vieweditar.php?r=Contraseña de Root incorrecta");
        exit();
    }
}else{
    $modelo->hacerUsuario($nuevoUsuario->getLogin());
    $nuevoUsuario->setIsroot(0);
    $nuevoUsuario->setRol(0);
    $bd->closeConexion();
    $sesion->setUsuario($nuevoUsuario);
    header("Location:../indexConectado.php?r=1");     
}
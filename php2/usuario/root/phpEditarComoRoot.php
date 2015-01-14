<?php
require '../../require/comun.php';
$sesion->autentificado("viewlogin.php");
if(!$sesion->isAdministrador()){
    header("Location:../phplogout.php");
    exit();
}

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$loginViejo = Leer::post("loginViejo");
$usuario = $modelo->get($loginViejo);

$login = Leer::post("login");
$claveNueva = Leer::post("claveNueva");
$claveConfirmada = Leer::post("claveConfirmada");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$passRoot = Leer::post("passRoot");

$nuevoUsuario = new Usuario($login, $claveNueva, $nombre, $apellidos, $email);
$cambioDeClave = strlen($claveNueva)> 0;
$cambioDeCorreo = $email!=$usuario->getEmail();

if($cambioDeClave){
    if($claveNueva==$claveConfirmada){
        $r = $modelo->editConClave($nuevoUsuario, $usuario->getLogin(), $usuario->getClave());
    }else{
        $r = 0;
    }
} else {
    $r = $modelo->editSinClave($nuevoUsuario, $loginViejo);
}

if ($r != 1){
    header("Location:viewUsuarios.php?r=0");
    exit();
}

if($cambioDeCorreo && $r>0){
    $id = md5($email.Configuracion::PEZARANA.$login);    
    $enlace = "Click aqui: <a href='".Entorno::getEnlaceCarpeta("../phpconfirmar.php?id=$id")."'>Validar cuenta</a>";       
    $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "alta en web", $enlace, Configuracion::CLAVEGMAIL);
}

if (isset($_POST['root'])){ //nuevo
    if($passRoot==Configuracion::passRoot){
        $r = $modelo->hacerRoot($login);
        $bd->closeConexion();
        header("Location:viewUsuarios.php?r=$r");
        exit();
    }else{
        header("Location:viewEditarComoRoot.php?r=Contraseña de Root incorrecta");
        exit();
    }
}else{
    $r = $modelo->hacerUsuario($login);
    $bd->closeConexion();
    header("Location:viewUsuarios.php?r=$r");     
}
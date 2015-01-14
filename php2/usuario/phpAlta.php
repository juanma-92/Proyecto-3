<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$claveConfirmada = Leer::post("claveConfirmada");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$passRoot = Leer::post("passRoot");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);


$usuario = new Usuario($login, $clave, $nombre, $apellidos, $email);

if (isset($_POST['root'])){
    if($passRoot==Configuracion::passRoot){
        $usuario->setIsroot(1);
        $usuario->setRol(1);
    }else{
        header("Location:viewalta.php?r=Contraseña de Root incorrecta");
        exit();
    }
}

$r = $modelo->add($usuario);
$bd->closeConexion();
if($r==1){
    $codigo = md5($email.Configuracion::PEZARANA.$login);    
    $direccion = Entorno::getEnlaceCarpeta("phpconfirmar.php?codigo=$codigo&login=$login");
    header ("Location: viewbienvenida.php?direccion=$direccion");
    exit;
}
header ("Location: viewalta.php?error=$r");
<?php
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$email = Leer::post("email");
$login = Leer::post("login");
if ($login != "") {
    $usuario = $modelo->get($login);
    if ($usuario != null) {
        $email = $usuario->getEmail();
        $id = md5($login . Configuracion::PEZARANA . $email);
        $enlace = "Click aqui: <a href='" . Entorno::getEnlaceCarpeta("viewrecupera.php?id=$id&login=$login") . "'>Cambiar contraseña</a>";
        echo $enlace;
        exit();
    }else{
        header("Location: viewolvido.php?r=No existe ese Login");
    }
}
if ($email != "") {
    $parametros["email"] = $email;
    $filas = $modelo->getListOlvido("email=:email", $parametros);
    $mensaje = "";
    foreach ($filas as $indice => $objeto) {
        $nombre = $objeto->getNombre();
        $email = $objeto->getEmail();
        $login = $objeto->getLogin();
        $id = md5($login . Configuracion::PEZARANA . $email);
        $mensaje .= "Usuario: $nombre . Click aqui: <a href='" . Entorno::getEnlaceCarpeta("viewrecupera.php?id=$id&login=$login") . "'>Cambiar contraseña</a><br/>";
    }
    if(empty($filas)==1){
        header("Location: viewolvido.php?r=No existe ese Correo");
    };
    /* $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "recuperacion clave", $mensaje, Configuracion::CLAVEGMAIL);
      if (!$correo) {
      header("Location: index.php");
      exit();
      } */
    echo $mensaje;
    exit();
}
$bd->closeConexion();
//header("Location: index.php");
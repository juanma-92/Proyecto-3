<?php
require '../require/comun.php';
$origen = Leer::post("origen");
$destino = Leer::post("destino");
$clave = Leer::post("clave");
$asunto =  Leer::post("asunto");
$mensaje = Leer::post("mensaje");
//$r = Correo::enviarHotmail($origen, $destino, $asunto, $mensaje, $clave);
$r = Correo::enviarGmail($origen, $destino, $asunto, $mensaje, $clave);
echo "resultado: $r <br/>";
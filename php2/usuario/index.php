<?php
require '../require/comun.php';
if($sesion->isSesion()){
    header("Location:../indexConectado.php"); 
    if($sesion->isAdministrador()){
        header("Location:viewRoot.php"); 
    }
}else{
    header("Location:../index.php"); 
}
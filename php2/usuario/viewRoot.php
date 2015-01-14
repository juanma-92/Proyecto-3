<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$u = $sesion->getUsuario();
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = Leer::get("r");
    if($r != null){
        if($r==0){
            echo 'Error al modificar';
        }else{
            echo 'Editado correctamente';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Persona</title>
        <script src="../js/main.js"></script>
    </head>
    <body>
        <div>
            Cuenta de <?php echo $u->getLogin();?>
            <a href="vieweditar.php">Editar cuenta</a>
            <a href="phplogout.php">Desconectarse</a>
        </div>
        <div>
            <a href="root/viewUsuarios.php">Ver usuarios</a>
            <a href="root/viewProductos.php">Ver productos</a>
        </div>
    </body>
</html>
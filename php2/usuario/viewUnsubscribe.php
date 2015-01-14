<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$usuario = $sesion->getUsuario();
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>
    </head>
    <body>
        <?php echo Leer::get("r"); ?>
        <form action="phpUnsubscribe.php" method="POST">
            <label>Estas a punto de dar de baja la cuenta: <?php echo $usuario->getLogin() ?></label><br/>
            <input type="submit" id="Dar de baja" value="Dar de baja" />
            <input type="button" value="Cancelar" onClick="history.back() ">
        </form>
    </body>
</html>
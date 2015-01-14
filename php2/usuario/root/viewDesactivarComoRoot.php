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
$usuario = $modelo->get($login);

?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>
    </head>
    <body>
        <?php echo Leer::get("r"); ?>
        <form action="phpDesactivarComoRoot.php?login=<?php echo $login;?>" method="POST">
            <label>Estas a punto de dar de baja la cuenta: <?php echo $login ?></label><br/>
            <input type="submit" id="Dar de baja" value="Dar de baja" />
            <input type="button" value="Cancelar" onClick="history.back() ">
        </form>
    </body>
</html>
<?php
require '../require/comun.php';
$usuario = $sesion->getUsuario();
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
?>
<!DOCTYPE html>
    <html> 
        <head>
            <meta charset="UTF-8">
            <title>Editar Usuario</title>
        </head>
        <body>
            <?php echo Leer::get("r"); ?>
            <form action="phpReactivar.php" method="POST">
                <label>¿Reactivar el usuario "<?php echo $usuario->getLogin() ?>"?</label><br/>
                <input type="submit" id="Reactivar" value="Reactivar" />
                <input type="button" value="Cancelar" onClick="history.back() ">
            </form>
        </body>
</html>
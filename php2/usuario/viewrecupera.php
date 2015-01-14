<?php 
require '../require/comun.php';
$id = Leer::get("id");
$login = Leer::get("login");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->cambiarClave($login, $id);
if ($r <= 0) {
    $bd->closeConexion();
    header("Location:index.php");
    exit();
}
$bd->closeConexion();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="phprecupera.php" method="POST">   
            <label for="clave">Clave</label>
            <input type="password" name="clave" value="" id="clave" required/>            
            <label for="claveConfirmada">Confirmar clave</label>
            <input type="password" name="claveConfirmada" value="" id="claveConfirmada" required/> 
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
            <input type="hidden" name="login" id="login" value="<?php echo $login; ?>"/>
            <input type="submit" value="Cambiar contraseña" />
        </form>
    </body>
</html>
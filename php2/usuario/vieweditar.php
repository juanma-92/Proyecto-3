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
        <script src="../js/editarUsuario.js"></script>
    </head>
    <body>
        <?php echo Leer::get("r"); ?>
        <form action="phpEditar.php" method="POST">            
            <label for="login">Login</label>                
            <input type="text" name="login" value="<?php echo $usuario->getLogin() ?>" id="login" required/><br/>
            <label for="clave"> Clave</label>
            <input type="password" name="clave" value="" id="clave" /> <br/>           
            <label for="claveNueva"> Clave Nueva</label>
            <input type="password" name="claveNueva" value="" id="claveNueva"/>            
            <label for="claveConfirmada"> Confirmar Clave Nueva</label>
            <input type="password" name="claveConfirmada" value="" id="claveConfirmada"/>  <br/>          
            <label for="nombre"> Nombre</label>
            <input type="text" name="nombre" value="<?php echo $usuario->getNombre() ?>" id="nombre" required/><br/>
            <label for="apellidos"> Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $usuario->getApellidos() ?>" id="apellidos" required/><br/>
            <label for="email"> Email</label>
            <input type="email" name="email" value="<?php echo $usuario->getEmail() ?>" id="email" required/><br/>
            <br/>
            <label for="root">Root: </label>
            <input type="checkbox" name="root" id="root" <?php if($usuario->getIsroot()==1){echo "checked";}?> />
            <input type="password" name="passRoot" placeholder="ContraseñaRoot" id="passRoot"/>
            <br/><br/>
            <input type="submit" id="modificar" value="Modificar" />
            <input type="button" value="Cancelar" onClick="history.back() ">
        </form>
        <a href="viewUnsubscribe.php">Darse de baja</a>
    </body>
</html>
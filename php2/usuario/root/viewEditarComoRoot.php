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
        <script src="../js/editarUsuario.js"></script>
    </head>
    <body>
        <?php echo Leer::get("r"); ?>
        <form action="phpEditarComoRoot.php" method="POST">            
            <label for="login">Login</label>                
            <input type="text" name="login" value="<?php echo $usuario->getLogin() ?>" id="login" required/>        
            <label for="claveNueva"> Clave Nueva</label>
            <input type="password" name="claveNueva" value="" id="claveNueva"/>            
            <label for="claveConfirmada"> Confirmar Clave Nueva</label>
            <input type="password" name="claveConfirmada" value="" id="claveConfirmada"/>            
            <label for="nombre"> Nombre</label>
            <input type="text" name="nombre" value="<?php echo $usuario->getNombre() ?>" id="nombre" required/>
            <label for="apellidos"> Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $usuario->getApellidos() ?>" id="apellidos" required/>
            <label for="email"> Email</label>
            <input type="email" name="email" value="<?php echo $usuario->getEmail() ?>" id="email" required/>
            <label for="email">Root: </label>
            <input type="checkbox" name="root" id="root" <?php if($usuario->getRol()=="administrador"){echo "checked";}?> />
            <input type="password" name="passRoot" placeholder="ContraseñaRoot" id="passRoot"/>
            <br/>
            <input type="hidden" name="loginViejo" value="<?php echo $usuario->getLogin() ?>"/>
            <input type="submit" id="modificar" value="Modificar" />
            <input type="button" value="Cancelar" onClick="history.back() ">
        </form>
    </body>
</html>
<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Login Usuario</title>
        <link href="../css/viewlogin.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="cabecera">
                <div id="titulo"><a href="../index.php"> Registrarse</a></div>
            </div>
            </div>
            <div id="error">
            <?php echo $error; ?>
                </div>
            <div id="contenido">
        <form action="phplogin.php" method="POST">            
            <input type="text" name="login" value="" id="login" placeholder="login" required/>
            <input type="password" name="clave" value="" id="clave" placeholder="clave" required/>
            <input type="submit" value="Login" />
        </form>
        <a href="viewolvido.php">He olvidado mi clave</a> <a href="viewalta.php">Registrarse</a><br/>
        </div>
    </body>
</html>
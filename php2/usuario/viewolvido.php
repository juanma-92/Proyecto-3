
<?php
require '../require/comun.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recuperar contraseña o login</title>
        <link href="../css/viewolvido.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="cabecera">
                <div id="titulo"><a href="../index.php"> Recuperar Cuenta</a></div>
            </div>
            </div>
            <div id="error">
        <?php $r = Leer::get("r"); echo $r; ?>
        <form action="phpolvido.php" method="POST">            
            <input type="text" name="login" value="" id="login" placeholder="login"/>
            o
            <input type="email" name="email" value="" id="email" placeholder="email"/>
            <input type="submit" value="Recuperar" />
        </form>
    </body>
</html>
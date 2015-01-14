<?php
require '../require/comun.php';
$direccion = Leer::get("direccion");
$login = Leer::get("login");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Bienvenida</title>
    </head>
    <body>
        <a href="<?php echo $direccion."&login=".$login; ?>"><?php echo $direccion; ?></a>
    </body>
</html>
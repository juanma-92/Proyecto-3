<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/indexConectado.css" rel="stylesheet" type="text/css">
    </head>
    <?php
        require 'require/comun.php';
        $sesion->autentificado("usuario/viewlogin.php");
        if ($sesion->isAdministrador()) {
            header("Location:usuario/viewRoot.php");
        }
        $u = $sesion->getUsuario();
        ?>
    <body>
        <div id="contenedor">
            <div id="cabecera">
                <div id="titulo"><a href="#">Inicio</div>
                <div id="enlaces">
                    <div id="cuentade">Cuenta de <?php echo $u->getLogin(); ?></div> 
                    <a href="usuario/vieweditar.php">Editar cuenta</a>
                    <a href="usuario/phplogout.php">Desconectarse</a>
                </div>
            </div>
            <div id="contenido">
        <div id="error">
            <?php
            $r = Leer::get("r");
            if ($r != null) {
                if ($r == 0) {
                    echo 'Error al modificar';
                } else {
                    echo 'Editado correctamente';
                }
            }
            ?>
        </div>
        
                <?php
                $bd = new BaseDatos();
                $consultaSql = "select * from producto";
                $res = $bd->setConsultaSql($consultaSql);
                echo "registros " . $res->rowCount() . "<br/>";
                while ($fila = $res->fetch()) {
                    echo $fila[0] . " ";
                    echo $fila[1] . " ";
                    echo $fila[2] . "<br/>";
                    /* echo $fila["id"]." ";
                      echo $fila["nombre"]." ";
                      echo $fila["precio"] . "<br/>";
                      foreach ($fila as $key => $value) {
                      echo $key."<br/>";
                      } */
                }
                $res->closeCursor();
                $con = null;
                ?>
                </div>
        </div>
                </body>
                </html>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio Desconectado</title>
        <link href="css/index.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="cabecera">
                <div id="titulo"><a href="#">Inicio</div>
                <div id="enlaces">
                    <form action="usuario/phplogin.php" method="POST">            
                        <input type="text" name="login" value="" id="login" placeholder="login" required/>
                        <input type="password" name="clave" value="" id="clave" placeholder="clave" required/>
                        <input type="submit" value="Login" />
                    </form>
                    <a id="registrarse" href="usuario/viewalta.php">Registrarse</a><br/>
                </div>
            </div>
            <div id="contenido">
                <?php
                require 'require/comun.php';
                if ($sesion->isSesion()) {
                    header("Location:indexConectado.php");
                    if ($sesion->isAdministrador()) {
                        header("Location:usuario/viewRoot.php");
                    }
                }
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

<!DOCTYPE html>
<?php
require '../../require/comun.php';
$r = Leer::get("r");
if($r != null){
    if($r==0){
        echo 'Error al modificar <br/>';
    }else{
        echo 'Editado correctamente <br/>';
    }
}
$pagina=0;
if(Leer::get("pagina")!= null){
    $pagina = Leer::get("pagina");
}
$sesion->autentificado("../viewlogin.php");
$u = $sesion->getUsuario();
if($u->getIsroot()!=1){
    header("Location:../phplogout.php");
    exit();
};
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div>
            Cuenta de <?php echo $u->getLogin();?>
            <a href="../vieweditar.php">Editar cuenta</a>
            <a href="../phplogout.php">Desconectarse</a>
        </div>
        <?php
        $servidor = 'localhost';
        $baseDatos = 'bdphp';
        $usuario = 'userphp';
        $clave = 'clavephp';
        try {
            $con = new PDO(
                'mysql:host=' . $servidor . ';dbname=' . $baseDatos, 
                $usuario, 
                $clave, 
                array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
            );
        } catch (PDOException $e) {
            echo "sin conexión" ."<br/>";
            exit();
        }
        $consultaSql = "select * from producto";
        $res = $con->query($consultaSql);
        echo "registros ". $res->rowCount()."<br/>";
        while( $fila = $res->fetch() ) {
            echo $fila[0]." ";
            echo $fila[1]." ";
            echo $fila[2] ." ";
            ?><a class='editar' href='phpBorrarProducto.php?login=<?php echo $fila[0];?>'>Borrar</a><br/><?php
        }
        $res->closeCursor();
        $con= null;
        ?>
        <br/>
        <form action="phpInsertProducto.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="" id="nombre" placeholder="nombre" required/>
            <label for="precio">Precio</label>
            <input id="precio" name="precio" placeholder="precio" type="number" value="" required/>
            <input type="submit" value="insertar" />
        </form>
        
            <a href=../viewRoot.php ><input type="button" value="back"></a>
    </body>
</html>

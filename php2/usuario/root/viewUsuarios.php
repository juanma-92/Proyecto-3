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
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$sesion->isAutentificado();
$u = $sesion->getUsuario();
if($u->getIsroot()!=1){
    header("Location:../phplogout.php");
    exit();
};
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$objetos = $modelo->getListPagina($pagina, Configuracion::RPP);
$enlaces = Paginacion::getEnlacesPaginacion($pagina, $modelo->count(), Configuracion::RPP);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>usuarios</title>
    </head>
    <body>
        <div>
            <div>
                Cuenta de <?php echo $u->getLogin();?>
                <a href="../vieweditar.php">Editar cuenta</a>
                <a href="../phplogout.php">Desconectarse</a>
            </div>
            <table border='1'>
                <thead>
                    <tr>
                        <th>login</th>
                        <th>clave</th>
                        <th>nombre</th>
                        <th>apellidos</th>
                        <th>email</th>
                        <th>rol</th>
                        <th>is root</th>
                        <th>is activo</th>
                        <th>fecha alta</th>
                        <th>fecha login</th>
                        <th colspan="2">operaciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="12">
                            <?php echo $enlaces["inicio"]; ?>
                            <?php echo $enlaces["anterior"]; ?>
                            <?php echo $enlaces["primero"]; ?>
                            <?php echo $enlaces["segundo"]; ?>
                            <?php echo $enlaces["actual"]; ?><!-- normalmente -->
                            <?php echo $enlaces["cuarto"]; ?>
                            <?php echo $enlaces["quinto"]; ?>
                            <?php echo $enlaces["siguiente"]; ?>
                            <?php echo $enlaces["ultimo"]; ?>
                        </th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($objetos as $indice => $objeto) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $objeto->getLogin(); ?>
                            </td>
                            <td>
                                <!--< ?php echo $objeto->getClave(); ?>-->
                                ********
                            </td>
                            <td>
                                <?php echo $objeto->getNombre(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getApellidos(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getEmail(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getRol(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getIsroot(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getIsactivo(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getFechaalta(); ?>
                            </td>
                            <td>
                                <?php echo $objeto->getFechalogin(); ?>
                            </td>
                            <td>
                                <a href="viewDesactivarComoRoot.php?login=<?php echo $objeto->getLogin(); ?>">desactivar</a>
                            </td>
                            <td>
                                <a href="viewEditarComoRoot.php?login=<?php echo $objeto->getLogin(); ?>">editar</a>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
            
            <a href=../viewRoot.php ><input type="button" value="back"></a>
        </div>
    </body>
</html>
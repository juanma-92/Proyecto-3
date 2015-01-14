<?php
class ModeloPersona {
    //Implementamos los métodos que necesitamos para trabajar con la persona
    private $bd;
    private $tabla = "persona";
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function add(Persona $objeto) {
        $sql = "insert into $this->tabla values (null, :nombre, :apellidos);";
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //return 0 si no fuera autonumerico        
    }
    function delete(Persona $objeto) {
        $sql = "delete from $this->tabla where id=:id;";
        $parametros["id"] = $objeto->getId();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    function deletePorId($id) {
        return $this->delete(new Persona($id));
    }
    //clave principal autonumérica
    function edit(Persona $objeto) {
        $sql = "update $this->tabla set nombre=:nombre, "
                . "apellidos=:apellidos where id=:id;";
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["id"] = $objeto->getId();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    //clave principal no autonumérica
    function editPK(Persona $objetoOriginal, Persona $objetoNuevo) {
        $sql = "update $this->tabla set id=:id nombre=:nombre, "
                . "apellidos=:apellidos where id=:idpk;";
        $parametros["id"] = $objetoNuevo->getId();
        $parametros["nombre"] = $objetoNuevo->getNombre();
        $parametros["apellidos"] = $objetoNuevo->getApellidos();
        $parametros["idpk"] = $objetoOriginal->getId();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    //le paso el id y me devuelve el objeto completo
    function get($id) {
        $sql = "select * from $this->tabla where id=:id;";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $persona = new Persona();
            $persona->set($this->bd->getFila());
            return $persona;
        }
        //return new Persona();
        return null;
    }
    function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            //return $this->bd->getFila()[0];
            return $this->bd->getFila();
        }
        return -1;
    }
    //poner en la clase util
    function getNumeroPaginas($rpp=  Configuracion::RPP){
        $lista = $this->count();
        return (ceil($lista[0] / $rpp) - 1);
    }
            
    function getList($pagina=0, $rpp=  Configuracion::RPP, $condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $principio = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderBy limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $persona = new Persona();
                $persona->set($fila);
                $list[] = $persona;
            }
        } else {
            return null;
        }
        return $list;
    }
    function selectHtml($id, $name, $condicion, $parametros, $orderBy = "1", 
            $valorSeleccionado = "", $blanco = TRUE, $textoBlanco = "&nbsp") {
        $select = "<select name='name' id='id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        //while y añado todos los option que quiera (hacerlo con el getList)
        $lista = $this->getList($condicion, $parametros, $orderBy);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getId() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .= "<option $selected value='" . $objeto->getId() . "'>"
                    . $objeto->getApellidos . ", " . $objeto->getNombre() . "</option>";
        }
        $select .= "</select>";
        return $select;
    }
}
?>
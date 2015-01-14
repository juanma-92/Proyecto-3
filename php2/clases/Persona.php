<?php
class Persona {
    //orden de las variables en el orden de la tabla
    private $id;
    private $nombre;
    private $apellidos;
    
    //orden igual que las variables, parametros por defecto null
    function __construct($id = null, $nombre = null, $apellidos = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }
    
    //array de datos y posicion inicial
    function set($datos, $inicio=0){
        $this->id = $datos[0 + $inicio];
        $this->nombre = $datos[1 + $inicio];
        $this->apellidos = $datos[2 + $inicio];        
    }
    
    public function getId() {
        return $this->id;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellidos() {
        return $this->apellidos;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }
}

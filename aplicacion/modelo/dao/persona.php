<?php

require_once("clsConexion.php");

class persona extends conexion {

    var $pe_id;
    var $pe_nombre;
    var $pe_decripcion;
    var $arregloPersona;

    function persona($pe_id) {
        if ($pe_id != '') {
            if ($pe_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM persona WHERE pe_id=$pe_id";
            } else {
                $this->arregloPersona = array();
                $queryBusqueda = "SELECT * FROM persona";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPersona($result);
                if ($indice != -1)
                    $this->arregloPersona[$indice] = $this->setArregloPersona($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setPersona($result) {
        $this->pe_id = $this->getField($result, 0);
        $this->pe_nombre = $this->getField($result, 1);
        $this->pe_descripcion = $this->getField($result, 2);
    }

    function obtenerPagin($script) {
        $this->arregloPersona = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPersona($result);
            if ($indice != -1)
                $this->arregloPersona[$indice] = $this->setArregloPersona($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloPersona = array();
        $queryBusqueda = "SELECT * FROM persona;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setPersona($result);
            if ($indice != -1)
                $this->arregloPersona[$indice] = $this->setArregloPersona($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloPersona($result) {
        $persona = new persona(0);
        $persona->pe_id = $this->getField($result, 0);
        $persona->pe_nombre = $this->getField($result, 1);
        $persona->pe_descripcion = $this->getField($result, 2);
        return $persona;
    }

    function insertar($pe_nombre, $pe_descripcion) {
        $queryBusqueda = "INSERT INTO persona (pe_nombre,pe_descripcion) VALUES('$pe_nombre','$pe_descripcion')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($pe_id) {
        $queryBusqueda = "DELETE FROM persona WHERE pe_id=$pe_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pe_id,$pe_nombre, $pe_descripcion) {
        $queryBusqueda = "UPDATE persona SET pe_nombre='$pe_nombre',pe_descripcion='$pe_descripcion' WHERE pe_id=$pe_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>

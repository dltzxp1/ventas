<?php

require_once("clsConexion.php");

class categoria extends conexion {

    var $ca_id;
    var $ca_nombre;
    var $ca_descripcion;
    var $ca_imagen;
    var $ca_tipo;
    var $ca_size;
    var $arregloCategoria;

    function categoria($ca_id) {
        if ($ca_id != '') {
            if ($ca_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM categoria WHERE ca_id=$ca_id";
            } else {
                $this->arregloCategoria = array();
                $queryBusqueda = "SELECT * FROM categoria";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setCategoria($result);
                if ($indice != -1)
                    $this->arregloCategoria[$indice] = $this->setArregloCategoria($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setCategoria($result) {
        $this->ca_id = $this->getField($result, 0);
        $this->ca_nombre = $this->getField($result, 1);
        $this->ca_descripcion = $this->getField($result, 2);
        $this->ca_imagen = $this->getField($result, 3);
        $this->ca_tipo = $this->getField($result, 4);
        $this->ca_size = $this->getField($result, 5);
    }

    function setArregloCategoria($result) {
        $categoria = new categoria(0);
        $categoria->ca_id = $this->getField($result, 0);
        $categoria->ca_nombre = $this->getField($result, 1);
        $categoria->ca_descripcion = $this->getField($result, 2);
        $categoria->ca_imagen = $this->getField($result, 3);
        $categoria->ca_tipo = $this->getField($result, 4);
        $categoria->ca_size = $this->getField($result, 5);
        return $categoria;
    }

    function obtenerPagin($script) {
        $this->arregloCategoria = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setCategoria($result);
            if ($indice != -1)
                $this->arregloCategoria[$indice] = $this->setArregloCategoria($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($queryBusqueda) {
        //$queryBusqueda = "INSERT INTO categoria (ca_nombre,ca_descripcion) VALUES('$ca_nombre','$ca_descripcion')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($ca_id) {
        $queryBusqueda = "DELETE FROM categoria WHERE ca_id=$ca_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($ca_id, $ca_nombre, $ca_descripcion) {
        $queryBusqueda = "UPDATE categoria SET ca_nombre='$ca_nombre',ca_descripcion='$ca_descripcion'WHERE ca_id=$ca_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function categoriaConsPagina($script) {
        $this->arregloCategoria = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setCategoria($result);
            if ($indice != -1)
                $this->arregloCategoria[$indice] = $this->setArregloCategoria($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>
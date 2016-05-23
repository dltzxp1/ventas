<?php

require_once("clsConexion.php");

class foto extends conexion {

    var $ca_id;
    var $pe_id;
    var $pr_id;
    var $fo_id;
    var $fo_nombre;
    var $fo_fecha;
    var $fo_descripcion;
    var $fo_imagen;
    var $fo_tipo;
    var $fo_size;
    var $arregloFoto;

    function foto($ca_id, $pr_id, $fo_id) {
        if ($ca_id != '') {
            if ($fo_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM foto WHERE ca_id=$ca_id AND pr_id=$pr_id AND fo_id=$fo_id";
            } else {
                $this->arregloFoto = array();
                $queryBusqueda = "SELECT * FROM foto WHERE ca_id=$ca_id AND pr_id=$pr_id";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setFoto($result);
                if ($indice != -1)
                    $this->arregloFoto[$indice] = $this->setArregloFoto($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setFoto($result) {
        $this->ca_id = $this->getField($result, 0);
        $this->pe_id = $this->getField($result, 1);
        $this->pr_id = $this->getField($result, 2);
        $this->fo_id = $this->getField($result, 3);
        $this->fo_nombre = $this->getField($result, 4);
        $this->fo_fecha = $this->getField($result, 5);
        $this->fo_descripcion = $this->getField($result, 6);
        $this->fo_imagen = $this->getField($result, 7);
        $this->fo_tipo= $this->getField($result, 8);
        $this->fo_size = $this->getField($result, 9);
    }

    function setArregloFoto($result) {
        $Foto = new foto(0, 0, 0);
        $Foto->ca_id = $this->getField($result, 0);
        $Foto->pe_id = $this->getField($result, 1);
        $Foto->pr_id = $this->getField($result, 2);
        $Foto->fo_id = $this->getField($result, 3);
        $Foto->fo_nombre = $this->getField($result, 4);
        $Foto->fo_fecha = $this->getField($result, 5);
        $Foto->fo_descripcion = $this->getField($result, 6);
        $Foto->fo_imagen = $this->getField($result, 7);
        $Foto->fo_tipo= $this->getField($result, 8);
        $Foto->fo_size = $this->getField($result, 9);
        return $Foto;
    }

    function obtenerPagin($script) {
        $this->arregloFoto = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFoto($result);
            if ($indice != -1)
                $this->arregloFoto[$indice] = $this->setArregloFoto($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloFoto = array();
        $queryBusqueda = "SELECT * FROM foto;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setFoto($result);
            if ($indice != -1)
                $this->arregloFoto[$indice] = $this->setArregloFoto($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($queryBusqueda) {
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pr_id, $ca_id, $cat_id, $si_id, $si_nombre, $si_descripcion, $si_paginaweb, $si_mail, $si_facebook, $si_twitter, $si_direccion, $si_telefono, $si_latitud, $si_longitud) {
        $queryBusqueda = "UPDATE foto SET cat_id=$cat_id,si_nombre='$si_nombre',si_descripcion='$si_descripcion',si_paginaweb='$si_paginaweb',si_mail='$si_mail',si_facebook='$si_facebook',si_twitter='$si_twitter',si_direccion='$si_direccion',si_telefono='$si_telefono',si_latitud='$si_latitud',si_longitud='$si_longitud',si_punto=ST_GeomFromText('POINT(" . $si_latitud . " " . $si_longitud . ")', 4326)  WHERE pr_id=$pr_id AND ca_id=$ca_id AND si_id=$si_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($ca_id, $pe_id, $pr_id, $fo_id) {
        $queryBusqueda = "DELETE FROM foto WHERE ca_id = $ca_id AND pe_id = $pe_id AND pr_id = $pr_id AND fo_id=$fo_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function FotoConsBusqueda($script) {
        $this->arregloFoto = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFoto($result);
            if ($indice != -1)
                $this->arregloFoto[$indice] = $this->setArregloFoto($result);
            $result->MoveNext();
            $indice++;
        }
    }

    /* Para servicios web */

    function FotoWS($pr_id) {
        if ($pr_id) {
            if ($pr_id > 0) {
                $indice = 0;
                $queryBusqueda = "SELECT * FROM foto WHERE pr_id=$pr_id";
            } else {
                /* $this->arregloFoto = array();
                  $queryBusqueda = "SELECT * FROM Foto where pr_id=$pr_id AND ca_id=$ca_id AND em_id=$em_id AND us_id=$us_id";
                  $indice = 0; */
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setFoto($result);
                if ($indice != -1)
                    $this->arregloFoto[$indice] = $this->setArregloFoto($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    /* WEB service MATERS FLOW */

    function Fotoswb($script) {
        $this->arregloFoto = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFoto($result);
            if ($indice != -1)
                $this->arregloFoto[$indice] = $this->setArregloFoto($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>
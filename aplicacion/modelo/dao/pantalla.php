<?php

require_once("clsConexion.php");

class pantalla extends conexion {

    var $us_id;
    var $ro_id;
    var $re_id;
    var $pa_id;
    var $pa_nombre;
    var $pa_descripcion;
    var $arregloPantalla;

    function pantalla($us_id, $ro_id, $re_id, $pa_id) {
        if ($us_id != '') {
            if ($pa_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM pantalla WHERE us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id AND pa_id=$pa_id";
            } else {
                $this->arregloPantalla = array();
                $queryBusqueda = "SELECT * FROM pantalla WHERE us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPantalla($result);
                if ($indice != -1)
                    $this->arregloPantalla[$indice] = $this->setArregloPantalla($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setPantalla($result) {
        $this->us_id = $this->getField($result, 0);
        $this->ro_id = $this->getField($result, 1);
        $this->re_id = $this->getField($result, 2);
        $this->pa_id = $this->getField($result, 3);
        $this->pa_nombre = $this->getField($result, 4);
        $this->pa_descripcion = $this->getField($result, 5);
    }

    function setArregloPantalla($result) {
        $Pantalla = new pantalla(0, 0, 0, 0);
        $Pantalla->us_id = $this->getField($result, 0);
        $Pantalla->ro_id = $this->getField($result, 1);
        $Pantalla->re_id = $this->getField($result, 2);
        $Pantalla->pa_id = $this->getField($result, 3);
        $Pantalla->pa_nombre = $this->getField($result, 4);
        $Pantalla->pa_descripcion = $this->getField($result, 5);
        return $Pantalla;
    }

    function obtenerPantallas($us_id) {
        $this->arregloPantalla = array();
        $queryBusqueda = "SELECT * FROM pantalla WHERE us_id=$us_id;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setPantalla($result);
            if ($indice != -1)
                $this->arregloPantalla[$indice] = $this->setArregloPantalla($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($us_id, $ro_id, $re_id, $pa_id, $pa_nombre, $pa_descripcion) {
        $queryBusqueda = "INSERT INTO pantalla VALUES($us_id,$ro_id,$re_id,$pa_id,'$pa_nombre','$pa_descripcion')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($us_id, $ro_id, $re_id, $pa_id) {
        $queryBusqueda = "DELETE FROM pantalla WHERE us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id AND pa_id=$pa_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
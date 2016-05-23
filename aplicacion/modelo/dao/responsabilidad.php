<?php

require_once("clsConexion.php");

class responsabilidad extends conexion {

    var $us_id;
    var $ro_id;
    var $re_id;
    var $re_nombre;
    var $re_descripcion;
    var $arregloResponsabilidad;

    function responsabilidad($us_id, $ro_id, $re_id) {
        if ($us_id != '') {
            if ($re_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM responsabilidad WHERE us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id";
            } else {
                $this->arregloResponsabilidad = array();
                $queryBusqueda = "SELECT * FROM responsabilidad WHERE us_id=$us_id AND ro_id=$ro_id";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setResponsabilidad($result);
                if ($indice != -1)
                    $this->arregloResponsabilidad[$indice] = $this->setArregloResponsabilidad($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setResponsabilidad($result) {
        $this->us_id = $this->getField($result, 0);
        $this->ro_id = $this->getField($result, 1);
        $this->re_id = $this->getField($result, 2);
        $this->re_nombre = $this->getField($result, 3);
        $this->re_descripcion = $this->getField($result, 4);
    }

    function setArregloResponsabilidad($result) {
        $responsabilidad = new responsabilidad(0, 0, 0);
        $responsabilidad->us_id = $this->getField($result, 0);
        $responsabilidad->ro_id = $this->getField($result, 1);
        $responsabilidad->re_id = $this->getField($result, 2);
        $responsabilidad->re_nombre = $this->getField($result, 3);
        $responsabilidad->re_descripcion = $this->getField($result, 4);
        return $responsabilidad;
    }

    function insertar($us_id, $ro_id, $re_nombre, $re_descripcion) {
        $queryBusqueda = "INSERT INTO responsabilidad (us_id,ro_id,re_nombre,re_descripcion) VALUES ($us_id,$ro_id,'$re_nombre','$re_descripcion')";
        $result = $this->select($queryBusqueda);
        return $result; //true o false
    }

    function eliminar($us_id, $ro_id, $re_id) {
        $queryBusqueda = "DELETE FROM responsabilidad WHERE us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($us_id, $ro_id, $re_id, $re_nombre, $re_descripcion) {
        $queryBusqueda = "UPDATE responsabilidad SET re_nombre='$re_nombre',re_descripcion='$re_descripcion' where us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id";
        $result = $this->select($queryBusqueda);
        return $result; //true o false
    }

    function responConsPagina($script) {
        $this->arregloResponsabilidad = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setResponsabilidad($result);
            if ($indice != -1)
                $this->arregloResponsabilidad[$indice] = $this->setArregloResponsabilidad($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>
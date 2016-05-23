<?php

require_once("clsConexion.php");

class prenda extends conexion {

    var $ca_id;
    var $pe_id;
    var $pr_id;
    var $pr_nombre;
    var $pr_material;
    var $pr_precio;
    var $pr_talla;
    var $pr_color;
    var $arregloPrenda;

    function prenda($ca_id, $pr_id) {
        if ($ca_id != '') {
            if ($pr_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM prenda WHERE ca_id=$ca_id AND pr_id=$pr_id";
            } else {
                $this->arregloPrenda = array();
                $queryBusqueda = "SELECT * FROM prenda where ca_id=$ca_id";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPrenda($result);
                if ($indice != -1)
                    $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setPrenda($result) {
        $this->ca_id = $this->getField($result, 0);
        $this->pe_id = $this->getField($result, 1);
        $this->pr_id = $this->getField($result, 2);
        $this->pr_nombre = $this->getField($result, 3);
        $this->pr_material = $this->getField($result, 4);
        $this->pr_precio = $this->getField($result, 5);
        $this->pr_talla = $this->getField($result, 6);
        $this->pr_color = $this->getField($result, 7);
    }

    function setArregloPrenda($result) {
        $prenda = new prenda(0, 0);
        $prenda->ca_id = $this->getField($result, 0);
        $prenda->pe_id = $this->getField($result, 1);
        $prenda->pr_id = $this->getField($result, 2);
        $prenda->pr_nombre = $this->getField($result, 3);
        $prenda->pr_material = $this->getField($result, 4);
        $prenda->pr_precio = $this->getField($result, 5);
        $prenda->pr_talla = $this->getField($result, 6);
        $prenda->pr_color = $this->getField($result, 7);
        return $prenda;
    }

    /* Control para que un usuario inrgrese los prendas aginados */

    function obtenerTamPrenda($em_id, $us_id) {
        $script = "SELECT * FROM prenda where em_id=$em_id AND us_id=$us_id";
        $this->arregloPrenda = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerPagin($script) {
        $this->arregloPrenda = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloPrenda = array();
        $queryBusqueda = "SELECT * FROM prenda;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }

//$ca_id, $pr_id,
    function insertar($ca_id, $pe_id, $pr_nombre, $pr_material, $pr_precio, $pr_talla, $pr_color) {
        $queryBusqueda = "INSERT INTO prenda (ca_id,pe_id,pr_id,pr_nombre, pr_material, pr_precio, pr_talla, pr_color)
                VALUES($ca_id,$pe_id,default,'$pr_nombre', '$pr_material', '$pr_precio', '$pr_talla', '$pr_color')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($ca_id, $pe_id, $pr_id, $pr_nombre, $pr_material, $pr_precio, $pr_talla, $pr_color) {
        $queryBusqueda = "UPDATE prenda SET pr_nombre='$pr_nombre',pr_material='$pr_material',pr_precio='$pr_precio',pr_talla='$pr_talla',pr_color='$pr_color' WHERE ca_id=$ca_id AND  pe_id=$pe_id AND pr_id=$pr_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($ca_id, $pr_id) {
        $queryBusqueda = "DELETE FROM prenda WHERE ca_id = $ca_id AND pr_id = $pr_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function prendaConsBusqueda($script) {
        $this->arregloPrenda = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }

    /* Para Paginacion */

    function prendaConsBusquedaPagina($script) {
        $this->arregloPrenda = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }

    /* Para servicios web */

    function prendaWS($pr_id) {
        if ($pr_id) {
            if ($pr_id > 0) {
                $indice = 0;
                $queryBusqueda = "SELECT * FROM prenda WHERE pr_id=$pr_id";
            } else {
                /* $this->arregloPrenda = array();
                  $queryBusqueda = "SELECT * FROM prenda where pr_id=$pr_id AND ca_id=$ca_id AND em_id=$em_id AND us_id=$us_id";
                  $indice = 0; */
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPrenda($result);
                if ($indice != -1)
                    $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    /* WEB service MATERS FLOW */

    function prendaswb($script) {
        $this->arregloPrenda = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>
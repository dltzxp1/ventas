<?php

require_once("clsConexion.php");

class usuario extends conexion {

    var $us_id;
    var $us_nombre;
    var $us_mail;
    var $us_clave;
    var $us_estado;
    var $arregloUsuario;

    function usuario($us_id) {
        if ($us_id != '') {
            if ($us_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM usuario where us_id=$us_id";
            } else {
                $this->arregloUsuario = array();
                $queryBusqueda = "SELECT * FROM usuario";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setUsuario($result);
                if ($indice != -1)
                    $this->arregloUsuario[$indice] = $this->setArregloUsuario($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setUsuario($result) {
        $this->us_id = $this->getField($result, 0);
        $this->us_inombre = $this->getField($result, 1);
        $this->us_mail = $this->getField($result, 2);
        $this->us_clave = $this->getField($result, 3);
        $this->us_estado = $this->getField($result, 4);
    }

    function setArregloUsuario($result) {
        $usuario = new usuario(0);
        $usuario->us_id = $this->getField($result, 0);
        $usuario->us_nombre = $this->getField($result, 1);
        $usuario->us_mail = $this->getField($result, 2);
        $usuario->us_clave = $this->getField($result, 3);
        $usuario->us_estado = $this->getField($result, 4);
        return $usuario;
    }

    function insertar($us_nombre, $us_mail, $us_clave, $us_estado) {
        $queryBusqueda = "INSERT INTO usuario (us_nombre,us_mail,us_clave,us_estado)
            VALUES('$us_nombre','$us_mail',MD5('$us_clave'),'$us_estado')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualizar($us_id, $us_nombre, $us_mail, $us_clave, $us_estado) {
        $queryBusqueda = "UPDATE usuario SET us_nombre='$us_nombre',us_mail='$us_mail',us_clave=md5('$us_clave'),us_estado='$us_estado' where us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($us_id) {
        $queryBusqueda = "DELETE FROM usuario WHERE us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function obtenerTodo() {
        $this->arregloHistoria = array();
        $queryBusqueda = "SELECT * FROM usuario;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setUsuario($result);
            if ($indice != -1)
                $this->arregloUsuario[$indice] = $this->setArregloUsuario($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function usuarioConsPagina($script) {
        $this->arregloUsuario = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setUsuario($result);
            if ($indice != -1)
                $this->arregloUsuario[$indice] = $this->setArregloUsuario($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>
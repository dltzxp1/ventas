<?php

require_once("../../modelo/dao/usuario.php");

$opcion = $_REQUEST['opcion'];
$us_nombre = $_REQUEST['us_nombre'];
$us_mail = $_REQUEST['us_mail'];
$us_clave = $_REQUEST['us_clave'];
$us_estado = $_REQUEST['us_estado'];

$objUsuario = new usuario('0');

if ($opcion == 0) {
    if ($objUsuario->insertar($us_nombre, $us_mail, $us_clave, $us_estado)) {
        echo utf8_encode("Usuario insertado ! ");
        exit;
    } else {
        echo utf8_encode("Por favor, ingrese de nuevo !");
        exit;
    }
} else if ($opcion == 1) {
    $us_id = $_REQUEST['us_id'];
    if ($objUsuario->actualizar($us_id, $us_nombre, $us_mail, $us_clave, $us_estado)) {
        echo utf8_encode("Usuario editado ! ");
    } else {
        echo utf8_encode("Por favor, ingrese de nuevo !");
    }
}
if ($opcion == 3) {
    $us_id = $_REQUEST['us_id'];
    $objUsuario->eliminar($us_id);
}
?>
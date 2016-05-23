<?php

require_once("../../modelo/dao/rol.php");

$opcion = $_REQUEST['opcion'];
$us_id = $_REQUEST['us_id'];
$ro_nombre = $_REQUEST['ro_nombre'];
$ro_descripcion = $_REQUEST['ro_descripcion'];

$objRol = new rol('0', '0');

if ($opcion == 0) {
    $inserto = $objRol->insertar($us_id, $ro_nombre, $ro_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo ingresar el Rol. Trate de nuevo';
    else
        echo 'Rol Ingresada!';
} else if ($opcion == 1) {
    $ro_id = $_REQUEST['ro_id'];
    $inserto = $objRol->actualiza($us_id, $ro_id, $ro_nombre, $ro_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar el Rol. Trate de nuevo';
    else
        echo 'Rol Editado';
}
if ($opcion == 3) {
    $ro_id = $_REQUEST['ro_id'];
    $objRol->eliminar($us_id, $ro_id);
}
?>
 

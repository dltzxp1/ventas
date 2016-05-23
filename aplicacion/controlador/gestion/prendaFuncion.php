<?php

require_once("../../modelo/dao/prenda.php");

$opcion = $_REQUEST['opcion'];
$ca_id = $_REQUEST['ca_id'];
$pe_id = $_REQUEST['pe_id'];
$pr_nombre = utf8_decode($_REQUEST['pr_nombre']);
$pr_material = utf8_decode($_REQUEST['pr_material']);
$pr_precio = utf8_decode($_REQUEST['pr_precio']);
$pr_talla = utf8_decode($_REQUEST['pr_talla']);
$pr_color = utf8_decode($_REQUEST['pr_color']);

$objPrenda = new prenda('0', '0');

if ($opcion == 0) {
    $inserto = $objPrenda->insertar($ca_id, $pe_id, $pr_nombre, $pr_material, $pr_precio, $pr_talla, $pr_color);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo ingresar el Prenda. Trate de nuevo';
    else
        echo 'Prenda Ingresado';
} else if ($opcion == 1) {
    $pr_id = $_REQUEST['pr_id'];
    $inserto = $objPrenda->actualiza($ca_id, $pe_id, $pr_id, $pr_nombre, $pr_material, $pr_precio, $pr_talla, $pr_color);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar la Prenda. Trate de nuevo';
    else
        echo 'Prenda Editado';
}
if ($opcion == 3) {
    $pr_id = $_REQUEST['pr_id'];
    $objPrenda->eliminar($ca_id, $pr_id);
}
?>
 

<?php

require_once("../../modelo/dao/categoria.php");

$opcion = $_REQUEST['opcion'];

$objCategoria = new categoria('0');

if ($opcion == 3) {
    $ca_id = $_REQUEST['ca_id'];
    $objCategoria->eliminar($ca_id);
}
?>
 

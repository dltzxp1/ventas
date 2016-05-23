<?php

require_once("../../modelo/dao/foto.php");

$opcion = $_REQUEST['opcion'];
$ca_id = $_REQUEST['ca_id'];
$pe_id = $_REQUEST['pe_id'];
$pr_id = $_REQUEST['pr_id'];
$fo_id = $_REQUEST['fo_id'];

$objSitio = new foto('0', '0', '0'); 

if ($opcion == 3) {
    $objSitio->eliminar($ca_id, $pe_id, $pr_id, $fo_id);
}
?>
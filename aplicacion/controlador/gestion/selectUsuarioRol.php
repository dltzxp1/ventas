<?php

require_once("../../modelo/dao/rol.php");

$us_id = $_REQUEST['us_id'];
$us_nombre = $_REQUEST['us_nombre'];

$objRol = new rol($us_id, '0');

$arrRol = $objRol->arregloRol;
$arreglo = array();

for ($i = 0; $i < count($arrRol); $i++) {
    $arreglo[$i][0] = $arrRol[$i]->us_id;
    $arreglo[$i][1] = $arrRol[$i]->ro_id;
    $arreglo[$i][2] = $arrRol[$i]->ro_nombre;
}
echo json_encode($arreglo);
?>

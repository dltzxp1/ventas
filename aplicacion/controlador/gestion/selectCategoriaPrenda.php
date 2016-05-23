<?php

require_once("../../modelo/dao/prenda.php");
$ca_id = $_REQUEST['ca_id'];
$objPrenda = new prenda($ca_id, '0');
$arrPrenda = $objPrenda->arregloPrenda;
$arreglo = array();

for ($i = 0; $i < count($arrPrenda); $i++) {
    $arreglo[$i][0] = $arrPrenda[$i]->ca_id;
    $arreglo[$i][1] = $arrPrenda[$i]->pe_id;
    $arreglo[$i][2] = $arrPrenda[$i]->pr_id;
    $arreglo[$i][3] = utf8_encode($arrPrenda[$i]->pr_nombre);
}
echo json_encode($arreglo);
?>

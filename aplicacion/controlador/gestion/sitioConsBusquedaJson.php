<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/sitio.php");

$pdId = $_REQUEST['pdId'];
$caId = $_REQUEST['caId'];
$catId = $_REQUEST['catId'];
//echo $pdId . ',' . $caId . ',' . $catId;

$script = "SELECT * FROM sitio WHERE pr_id=$pdId AND ca_id=$caId AND cat_id=$catId";
$objSitio = new sitio('0', '0', '0', '0', '0');
$objSitio->sitioConsBusqueda($script);
$arrSitio = $objSitio->arregloSitio;

$arreglo = array();
for ($i = 0; $i < count($arrSitio); $i++) {
    $arreglo[$i][0] = $arrSitio[$i]->si_latitud;
    $arreglo[$i][1] = $arrSitio[$i]->si_longitud;
    $arreglo[$i][2] = $arrSitio[$i]->si_nombre;
    $arreglo[$i][3] = $arrSitio[$i]->si_paginaweb;
    $arreglo[$i][4] = $arrSitio[$i]->si_facebook;
    $arreglo[$i][5] = $arrSitio[$i]->si_twitter;
    $arreglo[$i][6] = $arrSitio[$i]->si_direccion;
    $arreglo[$i][7] = $arrSitio[$i]->si_telefono;
}

echo json_encode($arreglo);
?>

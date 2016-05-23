<?php

require_once("../../modelo/dao/persona.php");

$opcion = $_REQUEST['opcion'];
$pe_nombre = $_REQUEST['pe_nombre'];
$pe_descripcion = $_REQUEST['pe_descripcion'];

$objPersona = new persona('');

if ($opcion == 0) {
    if ($objPersona->insertar(utf8_decode($pe_nombre), utf8_decode($pe_descripcion)))
        echo 'persona Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la Persona. Trate de nuevo';
}else if ($opcion == 1) {
    $pe_id = $_REQUEST['pe_id'];
    $inserto = $objPersona->actualiza($pe_id, utf8_decode($pe_nombre), utf8_decode($pe_descripcion));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita ral persona. Trate de nuevo';
    else
        echo 'persona Editada';
}
if ($opcion == 3) {
    $pe_id = $_REQUEST['pe_id'];
    $objPersona->eliminar($pe_id);
}
?>
 

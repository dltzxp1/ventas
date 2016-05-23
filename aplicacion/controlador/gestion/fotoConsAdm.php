<?php

require_once("../../modelo/dao/foto.php");
require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/persona.php");
require_once("../../modelo/dao/prenda.php");

$ca_id = $_REQUEST['ca_id'];
$pe_id = $_REQUEST['pe_id'];
$pr_id = $_REQUEST['pr_id'];
$fo_id = $_REQUEST['fo_id'];

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$ObjFoto = new foto($ca_id, $pr_id, $fo_id);
$ObjFotoPagina = new foto($ca_id, $pr_id, $fo_id);

$query = "SELECT * FROM foto WHERE ca_id=$ca_id AND pe_id=$pe_id AND pr_id=$pr_id LIMIT " . $RegistrosAEmpezar . "," . $RegistrosAMostrar;
$ObjFoto->obtenerPagin($query);

if ($fo_id == '0') {
    $arrFoto = $ObjFoto->arregloFoto;
    if (count($arrFoto) > 0) {
        echo "<table class='table table-hover' style='border:silver solid 2px;'>";
        echo "<thead><th>Categoria</th><th>Persona</th><th>Prenda</th>   <th>fecha</th><th>Tamaño</th><th>Tipo</th><th>Descripción</th><th>Foto</th><th>Eliminar</th></thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrFoto); $r++) {
            echo "<tr>";
            //echo "<td>" . $arrFoto[$r]->ca_id . "," . $arrFoto[$r]->pe_id . "," . $arrFoto[$r]->pr_id . "," . $arrFoto[$r]->fo_id . "</td>";
            //echo "<td>" . $arrFoto[$r]->ca_id . "</td>";
            echo "<td>";
            $objCategoria = new categoria('0');
            $arrCategoria = $objCategoria->arregloCategoria;
            for ($i = 0; $i < count($arrCategoria); $i++) {
                if ($arrCategoria[$i]->ca_id == $arrFoto[$r]->ca_id) {
                    if (strlen($arrCategoria[$i]->ca_nombre) >= 15) {
                        echo substr(utf8_encode($arrCategoria[$i]->ca_nombre), 0, 15) . '.';
                    } else {
                        echo utf8_encode($arrCategoria[$i]->ca_nombre);
                    }
                }
            }
            
            echo "<td>";
            $objPersona = new persona('0');
            $arrPersona = $objPersona->arregloPersona;
            for ($i = 0; $i < count($arrPersona); $i++) {
                if ($arrPersona[$i]->pe_id == $arrFoto[$r]->pe_id) {
                    if (strlen($arrPersona[$i]->pe_nombre) >= 15) {
                        echo substr(utf8_encode($arrPersona[$i]->pe_nombre), 0, 15) . '.';
                    } else {
                        echo utf8_encode($arrPersona[$i]->pe_nombre);
                    }
                }
            }
            echo "</td>";


            echo "<td>" . $arrFoto[$r]->fo_nombre . "</td>";
            echo "<td>" . $arrFoto[$r]->fo_fecha . "</td>";
            echo "<td>" . floor($arrFoto[$r]->fo_size/1024) . " KB</td>";
            echo "<td>" . $arrFoto[$r]->fo_tipo . "</td>";
            echo "<td><pre>" . $arrFoto[$r]->fo_descripcion . "</pre></td>";
            echo "<td><img style='width:200px;height:200px;' src='../../../controlador/gestion/verImagen.php?ca_id=" . $arrFoto[$r]->ca_id . "&pr_id=" . $arrFoto[$r]->pr_id . "&fo_id=" . $arrFoto[$r]->fo_id . "' /></td>";
            echo "<td valign='center'><a title='Eliminar Foto " . $arrFoto[$r]->fo_nombre . "' href='javascript:delFotoAdm(3,\"" . $arrFoto[$r]->ca_id . "\",\"" . $arrFoto[$r]->pe_id . "\",\"" . $arrFoto[$r]->pr_id . "\",\"" . $arrFoto[$r]->fo_id . "\");'><img style='width:16px;height:16px;border:0;' src='../../img/eliminar.png' /></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        /* Pagina */

        $NroRegistros = count($ObjFotoPagina->arregloFoto);
        //$NroRegistros = count($objPersonaPagina->arregloPersona);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2" style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginFotoAdm('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginFotoAdm('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginFotoAdm('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginFotoAdm('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";

        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='PE_id' value='$pe_id'>";
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='FO_id' value='$fo_id'>";
    } else {
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='PE_id' value='$pe_id'>";
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='FO_id' value='$fo_id'>";
    }
}
?>
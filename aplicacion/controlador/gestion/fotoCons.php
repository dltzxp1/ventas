<?php

require_once("../../modelo/dao/persona.php");
require_once("../../modelo/dao/foto.php");

$ca_id = $_REQUEST['ca_id'];
$pe_id = $_REQUEST['pe_id'];
$pr_id = $_REQUEST['pr_id'];
$fo_id = $_REQUEST['fo_id'];

session_start();
$_SESSION["caId"] = $_REQUEST['ca_id'];
$_SESSION["peId"] = $_REQUEST['pe_id'];
$_SESSION["prId"] = $_REQUEST['pr_id'];
$_SESSION["foId"] = $_REQUEST['fo_id'];

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$Objfoto = new foto($ca_id, $pr_id, $fo_id);
$ObjfotoPagina = new foto($ca_id, $pr_id, $fo_id);

//$script = "SELECT * FROM prenda WHERE ca_id=$ca_id LIMIT " . $RegistrosAEmpezar . "," . $RegistrosAMostrar;
$query = "SELECT * FROM foto WHERE ca_id=$ca_id AND pr_id=$pr_id LIMIT " . $RegistrosAEmpezar . "," . $RegistrosAMostrar;
$Objfoto->obtenerPagin($query);

if ($fo_id == '0') {
    $arrFoto = $Objfoto->arregloFoto;
    if (count($arrFoto) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th>Fecha</th> <th>Persona</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrFoto); $r++) {
            echo "<tr>";
            echo "<td id='pe_id" . $r . "'  style='display:none;'>" . $arrFoto[$r]->pe_id . "</td>";
            echo "<td id='fo_id" . $r . "'  style='display:none;'>" . $arrFoto[$r]->fo_id . "</td>";
            echo "<td id='foi_nombre" . $r . "'>";
            if (strlen($arrFoto[$r]->fo_nombre) >= 15) {
                echo substr($arrFoto[$r]->fo_nombre, 0, 15) . '.';
            } else {
                echo $arrFoto[$r]->fo_nombre;
            }
            echo "</td>";

            echo "<td id='fo_nombre" . $r . "'>";
            if (strlen($arrFoto[$r]->fo_fecha) >= 15) {
                echo substr($arrFoto[$r]->fo_fecha, 0, 15) . '.';
            } else {
                echo $arrFoto[$r]->fo_fecha;
            }
            echo "</td>";


            echo "<td id='cat_id" . $r . "'>";
            $objPersona = new persona('0');
            $arrPersona = $objPersona->arregloPersona;

            for ($i = 0; $i < count($arrPersona); $i++) {
                if ($arrPersona[$i]->pe_id == $arrFoto[$r]->pe_id) {
                    if (strlen($arrPersona[$i]->pe_nombre) >= 15) {
                        echo substr(utf8_encode($arrPersona[$i]->pe_nombre, 0, 15)) . '.';
                    } else {
                        echo utf8_encode($arrPersona[$i]->pe_nombre);
                    }
                }
            }

            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $NroRegistros = count($ObjfotoPagina->arregloFoto);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginFoto('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginFoto('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginFoto('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginFoto('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";

        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='PE_id' value='$pe_id'>";
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='FO_id' value='$fo_id'>";
    } else {
        echo 'Lo sentimos, su consulta no produjo resultados. <br>';
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='PE_id' value='$pe_id'>";
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='FO_id' value='$fo_id'>";
    }
}
?>
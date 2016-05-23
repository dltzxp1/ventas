<?php

require_once("../../modelo/dao/persona.php");
$pe_id = $_REQUEST['pe_id'];

$objPersona = new persona($pe_id);
$objPersonaPagina = new persona($pe_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM persona  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objPersona->obtenerPagin($script);

if ($pe_id == '0') {
    $arrPersona = $objPersona->arregloPersona;
    if (count($arrPersona) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrPersona); $r++) {
            echo "<tr>";
            echo "<td id='pe_nombre" . $r . "'>";
            //$arrPersona[$r]->pe_nombre .  
            if (strlen(utf8_encode($arrPersona[$r]->pe_nombre)) >= 20) {
                echo substr(utf8_encode($arrPersona[$r]->pe_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrPersona[$r]->pe_nombre);
            }
            echo "</td>";
            echo "<td id='pe_descripcion" . $r . "' style='display:none;'>" . $arrPersona[$r]->pe_descripcion . "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Persona " . $arrPersona[$r]->pe_nombre . "' href='javascript:delPersona(3,\"" . $arrPersona[$r]->pe_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Persona " . $arrPersona[$r]->pe_nombre . "' href='javascript:editPersona(\"" . $arrPersona[$r]->pe_id . "\",\"" . utf8_encode($arrPersona[$r]->pe_nombre) . "\",\"" . utf8_encode($arrPersona[$r]->pe_descripcion) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objPersonaPagina->arregloPersona);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginPersona('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginPersona('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginPersona('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginPersona('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>

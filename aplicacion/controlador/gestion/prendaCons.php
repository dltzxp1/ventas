<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/prenda.php");

$ca_id = $_REQUEST['ca_id'];
$pr_id = $_REQUEST['pr_id'];
//echo $ca_id.','.$pr_id;
$objPrenda = new prenda($ca_id, $pr_id);
$objPrendaPagina = new prenda($ca_id, $pr_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM prenda WHERE ca_id=$ca_id LIMIT " . $RegistrosAEmpezar . "," . $RegistrosAMostrar;
$objPrenda->obtenerPagin($script);

if ($pr_id == '0') {
    $arrPrenda = $objPrenda->arregloPrenda;
    if (count($arrPrenda) > 0) {
        echo "<table class = 'table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrPrenda); $r++) {
            echo "<tr>";
            echo "<td id = 'pr_id" . $r . "' style = 'display:none;'>" . $arrPrenda[$r]->pr_id . "</td>";

            echo "<td id = 'pr_nombre" . $r . "' style = 'display:block;'>";
            if (strlen(utf8_encode($arrPrenda[$r]->pr_nombre)) >= 18) {
                echo substr(utf8_encode($arrPrenda[$r]->pr_nombre), 0, 18) . '.';
            } else {
                echo utf8_encode($arrPrenda[$r]->pr_nombre);
            }
            echo "</td>";
            echo "<td id = 'pe_descripcion" . $r . "' style = 'display:none;'>" . $arrPrenda[$r]->pr_material . "</td>";

            echo "<td align = 'center'>";
            echo "<a title = 'Eliminar Prenda " . $arrPrenda[$r]->pr_nombre . "' href = 'javascript:delPrenda(3,\"" . $arrPrenda[$r]->ca_id . "\",\"" . $arrPrenda[$r]->pr_id . "\");'> <img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title = 'Editar Prenda " . $arrPrenda[$r]->pr_nombre . "' href = 'javascript:editPrenda(\"" . $arrPrenda[$r]->ca_id . "\",\"" . $arrPrenda[$r]->pe_id . "\",\"" . $arrPrenda[$r]->pr_id . "\",\"" . utf8_encode($arrPrenda[$r]->pr_nombre) . "\",\"" . utf8_encode($arrPrenda[$r]->pr_material) . "\",\"" . utf8_encode($arrPrenda[$r]->pr_precio) . "\",\"" . utf8_encode($arrPrenda[$r]->pr_talla) . "\",\"" . utf8_encode($arrPrenda[$r]->pr_color) . "\");' > <img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";
        /* Paginacion */
        $NroRegistros = count($objPrendaPagina->arregloPrenda);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginPrenda('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginPrenda('$PagAnt')\"  > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a  onclick=\"PaginPrenda('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginPrenda('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
    echo "<input style='display:none;' type='text' id='CA_id' value='$ca_id'>";
}
?>

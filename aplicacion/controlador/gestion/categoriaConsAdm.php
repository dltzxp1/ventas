<?php

require_once("../../modelo/dao/categoria.php");

$ca_id = $_REQUEST['ca_id'];

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$ObjCategoria = new categoria('0');
$ObjCategoriaPagina = new categoria('0');

$query = "SELECT * FROM categoria LIMIT " . $RegistrosAEmpezar . "," . $RegistrosAMostrar;
$ObjCategoria->obtenerPagin($query);


if ($ca_id == '0') {
    $arrCategoria = $ObjCategoria->arregloCategoria;
    if (count($arrCategoria) > 0) {
        echo "<table class='table table-hover' style='border:silver solid 2px;'>";
        echo "<thead><th>Nombre</th><th>Tamaño</th> <th>Tipo</th><th>Descripcion</th><th>Imagen</th><th>Eliminar</th></thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrCategoria); $r++) {
            echo "<td>" . $arrCategoria[$r]->ca_nombre . "</td>";

            echo "<td>" . floor($arrCategoria[$r]->ca_size / 1024) . " KB </td>";
            echo "<td>" . $arrCategoria[$r]->ca_tipo . "</td>";

            echo "<td><pre>" . $arrCategoria[$r]->ca_descripcion . "</pre></td>";
            echo "<td><img style='width:200px;height:200px;' src='../../../controlador/gestion/verImagenCategoria.php?ca_id=" . $arrCategoria[$r]->ca_id . "' /></td>";
            echo "<td valign='center'><a title='Eliminar Categoria " . $arrCategoria[$r]->ca_nombre . "' href='javascript:delCatAdm(3,\"" . $arrCategoria[$r]->ca_id . "\");'><img style='width:16px;height:16px;border:0;' src='../../img/eliminar.png' /></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        /* Pagina */

        $NroRegistros = count($ObjCategoriaPagina->arregloCategoria);
        //$NroRegistros = count($objPersonaPagina->arregloPersona);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2" style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginCategoriaAdm('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginCategoriaAdm('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginCategoriaAdm('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginCategoriaAdm('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
        
    } else {
        
    }
}
?>
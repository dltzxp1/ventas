<?php
/* * **************************** */

session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admfoto.php";
    $usId = $_SESSION['usId'];
    $objPant = new pantalla('', '', '', '', '');
    $objPant->obtenerPantallas($usId);
    $arrPant = $objPant->arregloPantalla;

    for ($q = 0; $q < count($arrPant); $q++) {
        if ($arrPant[$q]->pa_nombre == $pantalla) {
            $existe = 1;
        }
    }
    if ($existe == 0) {
        echo '<div class="alert alert-error">
  <a class="close" data-dismiss="alert"></a>
  <strong>No tiene Pemisos !!</strong>
  </div>
  </div>';
        exit;
    }
}
/* * **************************** */



require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/prenda.php");

$ca_id = isset($_REQUEST['ca_id'])?$_REQUEST['ca_id']:null;
$pr_nombre = isset($_REQUEST['pr_nombre'])?$_REQUEST['ca_id']:null;

//$dise_nombre=isset($_REQUEST['dise_nombre'])?$_REQUEST['dise_nombre']:null; 

$objCategoria = new categoria('0');
$arrCategoria = $objCategoria->arregloCategoria;
//echo count();

$pr_id = isset($_REQUEST['pr_id'])?$_REQUEST['ca_id']:null;
$pr_nombre = isset($_REQUEST['pr_nombre'])?$_REQUEST['ca_id']:null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../vista/js/estiloadm.css" />
    </head> 
    <style>
        .solobordeIng{
            display: block;
            position: absolute;
            background: white;  
            left: 30%;
            width: 40%;
            height: 4%;
            top: 10%;
        }

        #cabBotones{
            display: block;
            top: 15%; 
            padding-top: 1%;
            position: absolute;
            left:30%; 
            width: 40%; 
            z-index: 100;
            height: 12%;
        }

        #divTabla{
            display: block;
            top: 29%;
            position: absolute;
            left:30%; 
            width: 40%;
            z-index: 40;
            height:65%;
            background: white;
        }


    </style>
    <script> 
        //window.onload=consFoto(0,0,0);
    </script>
    <body>
        <div class="solobordeIng" align="center">
            Adminsitración de Foto
        </div>
        <div id="cabBotones">
            <ul class="nav nav-tabs" style="height: auto;margin-left: 0%;">
                <li><a title="Agregar Foto" href="../vista/pantalla/img/admfoto.php"><img src="../vista/img/addPhoto.png" /></a></li>
                <li>
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="ca_nombre" style="width: 150px;">Seleccione Categoria</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown" >
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu"  style="left: 10%;">
                            <?php
                            for ($r = 0; $r < count($arrCategoria); $r++) {
                                echo "<li> <a href=\"javascript:selectCategoriaPrenda('" . $arrCategoria[$r]->ca_id . "','" . '0' . "');asignarCategoria('" . utf8_encode($arrCategoria[$r]->ca_nombre) . "');\">";
                                if (strlen(utf8_encode($arrCategoria[$r]->ca_nombre)) >= 18) {
                                    echo substr(utf8_encode($arrCategoria[$r]->ca_nombre), 0, 18) . '.';
                                } else {
                                    echo utf8_encode($arrCategoria[$r]->ca_nombre);
                                }
                                echo "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </li>

                <li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="pr_nombre" style="width: 150px;">Seleccione Prenda </button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-menu" style="left: 10%;">
                            <li>
                                <a>Seleccione un Articulo</a>
                            </li>
                        </ul>
                    </div>  
                </li>
            </ul>
        </div>
        <div id='divTabla'></div>
    </body>
</html>
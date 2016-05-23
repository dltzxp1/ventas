<?php
/* * **************************** */
session_start();
require_once("../../../modelo/dao/pantalla.php");
require_once("../../../modelo/dao/foto.php");

$objFoto = new foto('0', '0', '0');

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../../index.php");
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

# Muestra el mensaje de confirmación
$postback = (isset($_POST["botonn"])) ? true : false;

///unset($foo);


$ca_id = isset($_SESSION["caId"])?$_SESSION["caId"]:NULL;
$pe_id = isset($_SESSION["peId"])?$_SESSION["caId"]:NULL;
$pr_id = isset($_SESSION["prId"])?$_SESSION["caId"]:NULL;



//echo $ca_id.','.$pe_id.','.$pr_id;
//echo
/*
$ca_id = $_SESSION["caId"];
$pe_id = $_SESSION["peId"];
$pr_id = $_SESSION["prId"];
*/
$tam=isset($_FILES["archivo"]["size"])?$_FILES["archivo"]["size"]:null;  
$ban = 0;
if (!$tam) {
    $ban = 0;
} else {
    $ban = 1;
}
$banImg = 0;
if ($postback) {
    if (!$_POST['fo_nombre'] == "" && !$_POST['fo_descripcion'] == "" && !$_FILES["archivo"]["name"] == "" && $ban == 1) {
        echo "SI";
        if ($tam < 307200) {
            
            echo "SI 2";
            $fo_nombre = $_POST['fo_nombre'];
            $fo_fecha = $_POST['fo_fecha'];
            $fo_descripcion = $_POST['fo_descripcion'];
            $tmp_name = $_FILES["archivo"]["tmp_name"];
            $type = $_FILES["archivo"]["type"];
            $size = $_FILES["archivo"]["size"];

            # Contenido del archivo
            $fp = fopen($tmp_name, "rb");
            $buffer = fread($fp, filesize($tmp_name));
            fclose($fp);
            $datos = base64_encode($buffer);


            $imagen = addslashes(fread(fopen($tmp_name, "rb"), filesize($tmp_name)));

            $sql = "INSERT INTO foto(ca_id,pe_id,pr_id,fo_nombre,fo_fecha,fo_descripcion,fo_imagen,fo_tipo,fo_size)
                VALUES ($ca_id,$pe_id,$pr_id,'$fo_nombre','$fo_fecha','$fo_descripcion','$imagen','$type','$size')";

            if ($objFoto->insertar($sql) == true) {
                $banImg = 1;
            }
        }
    } else {
        $banImg = 10;
    }
}

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
        <title>Insertar archivos en un campo blob de PostgreSQL</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/bootstrap/css/bootstrap.css" ></link>
        <link rel="stylesheet" type="text/css" href="../../../librerias/bootstrap/css/bootstrap-responsive.css" ></link>  
        <script src="../../js/ajax.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../librerias/datetimepic/css/bootstrap-datetimepicker.min.css" ></link>
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/jquery-1.7.1.min.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/jQuery-form.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/alert.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/jquery.js" />
    </head>

    <body onload="consFotoAdm('<?php echo $ca_id; ?>','<?php echo $pe_id; ?>','<?php echo $pr_id; ?>','<?php echo 0; ?>')">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse navbar-responsive-collapse">
                        <ul class="nav pull-center"> 
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="../../img/city.png"></img> Administración de Fotos </a>
                            </li>  
                        </ul>  
                    </div> 
                </div>
            </div> 
        </div>
        <div>
            <?php
            if ($banImg == 1) {
                echo ' <div class="alert alert-success">
                 <a class="close" data-dismiss="alert">  </a>
                    <strong><img src="../../img/ok.png"/> Imagen insertada ! </strong>
                </div> 
                </div>';
            } else if ($banImg == 10) {
                echo ' <div class="alert alert-error">
                 <a class="close" data-dismiss="alert">  </a>
                    <strong><img src="../../img/error.png"/> Imagen NO insertada ! </strong>
                </div> 
                </div>';
            }
            ?></div>

        <div id="contenedor" style="width: 70%">
            <div id="postform">
                <div id="error" style="display: block;"> </div>
                <form name="frmblob" id="frmblob" method="POST" enctype="multipart/form-data" action="admfoto.php">
                    <table>
                        <tr>
                            <td><strong>Nombre:</strong></td><td><input placeholder='Nombre [5-32]' type="text" id="fo_nombre" name="fo_nombre" /></td>
                        </tr>
                        <tr><td><strong>Fecha Inicio</strong>  :</td> 
                            <td> 
                                <div id='datetimepicker4' class='input-append'>
                                    <input data-format='yyyy-MM-dd' type='text' id='fo_fecha' name='fo_fecha' readonly></input>
                                    <span class='add-on'>
                                        <i data-time-icon='icon-time' data-date-icon='icon-calendar'>
                                        </i>
                                    </span>
                                </div>
                                <script type='text/javascript'>
                                    $(function() {
                                        $('#datetimepicker4').datetimepicker({
                                            pickTime: false,
                                            language: 'es'
                                        });
                                    });
                                </script> 
                            </td>
                            <tr>
                                <td><strong>Descripción</strong></td><td><textarea placeholder='Tras esto quedaron unos pocos bastiones de....' style='width:250px;height:100px;' rows='4' cols='26' id="fo_descripcion" name="fo_descripcion" ></textarea> </td>
                            </tr>
                            <tr>
                                <td><strong>Foto</strong></td><td><span class="btn btn-file"><input type="file" id="archivo" name="archivo" title="Archivo a subir" size="50" /> IMAGEN MENOR a 300KB / DIMENSIÓN 800X450 pixeles</span></td>
                                <td colspan="3"> 
                                    <button title="Ingresar imagen" type="submit" name="botonn" id="botonn"  style="border: 0;" onclick="validarCamposFoto();"> <img src="../../img/save.png"/> </button>
                                    <a title="Actualizar página" href="" style="color: white;"> <img src="../../img/reload.png"/></a>
                                    <a title="Regresar hacia administración" href="../../../controlador/ingreso.php"> <img src="../../img/Admin.png"/> </a>
                                </td>
                            </tr>
                    </table>  
                </form>
            </div>
        </div>

        <div id="contenedorRpt" style="width: 70%;">

        </div>
        <script language="javascript" type="text/javascript" src="../../../librerias/bootstrap-typeahead.js"></script>
        <script language="javascript" type="text/javascript" src="../../../librerias/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="../../../librerias/datetimepic/js/bootstrap-datetimepicker.min.js"></script>
        <script language="javascript" type="text/javascript" src="../../../librerias/datetimepic/js/bootstrap-datepicker.es.js"></script>
    </body>
</html>


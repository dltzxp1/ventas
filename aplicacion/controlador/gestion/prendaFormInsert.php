<?php
include_once '../../modelo/dao/persona.php';
$CA_id = isset($_REQUEST['CA_id'])?$_REQUEST['CA_id']:null;

$objPersona = new persona('0');
$arrPersona = $objPersona->arregloPersona;

echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Prenda   <img  style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';

echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='0px' cellpadding='0px' align='center'>
        <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
        <tr style='display:none;'><td>PR_id:</td>      <td> <input type='text' id='ca_id' value='$CA_id'/></td></tr>
            <tr><td><strong>Persona</strong></td><td>
                <div class='btn-group' style='width: 200px;position: relative;'>
                    <button class='btn' id='pe_nombre' style='width: 196px;'>Seleccione Persona</button>
                    <button class='btn dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                    </button>
                    <ul class='dropdown-menu'  style='left: 10%;'>";
                        for ($r = 0; $r < count($arrPersona); $r++) {
                            echo "<li> <a href=\"javascript:asignarPersona('" . $arrPersona[$r]->pe_id . "','" . utf8_encode($arrPersona[$r]->pe_nombre) . "');\">" . utf8_encode($arrPersona[$r]->pe_nombre) . "</a></li>";
                            }
                       echo "</ul>
                </div>       
                <input type='text' id='pe_id' style='display:none;'/>
       </td>
       </tr>
       
        <tr><td><strong>Nombre:</strong></td>           <td> <input  placeholder='Nombre Articulo'  type='text' id='pr_nombre' /></td></tr>
        <tr><td><strong>Material :</strong></td>        <td> <textarea placeholder='Ingrese Descripción..' style='width:210px;height:150px;' rows='4' cols='26' id='pr_material' ></textarea></td></tr>
        <tr><td><strong>Precio:</strong></td>           <td> <input placeholder='Ingrese precío' type='text' id='pr_precio'/></td></tr>
        <tr><td><strong>Talla:</strong></td>            <td> <input placeholder='Ingrese tallas' type='text' id='pr_talla'/></td></tr>
        <tr><td><strong>Color:</strong></td>            <td> <input placeholder='Ingrese colores' type='text' id='pr_color'/></td></tr>
                        
   </table></td></tr>    
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposPrenda();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_pr' value='0' style='display:none'/>
    </div>";
?>
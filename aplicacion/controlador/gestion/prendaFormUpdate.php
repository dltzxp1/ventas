<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Editar Prenda <img style="position:absolute;left:95.5%;margin-top:1px;"  id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='0px' cellpadding='0px' align='center'>
        <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
            <tr style='display:none;'><td>ca_id:</td><td>           <input type='text' id='ca_id' value='" . $_REQUEST['ca_id'] . "' /></td></tr>
            <tr style='display:none;'><td>pe_id:</td><td>           <input type='text' id='pe_id' value='" . $_REQUEST['pe_id'] . "' /></td></tr>
            <tr style='display:none;'><td>pr_id:</td><td>           <input type='text' id='pr_id' value='" . $_REQUEST['pr_id'] . "' /></td></tr>
                                                                                              
            <tr><td><strong>Nombre:</strong></td>       <td><input type='text' id='pr_nombre' value='" . $_REQUEST['pr_nombre'] . "' /></td></tr>
            <tr><td><strong>Material:</strong></td>     <td><textarea style='width:210px;height:150px;' rows='4' cols='26' id='pr_material' >" . $_REQUEST['pr_material'] . "</textarea> </td></tr>
            <tr><td><strong>Precio:</strong></td>       <td><input type='text' id='pr_precio' value='" . $_REQUEST['pr_precio'] . "' /></td></tr>
            <tr><td><strong>Talla:</strong></td>        <td><input type='text' id='pr_talla' value='" . $_REQUEST['pr_talla'] . "' /></td></tr>
            <tr><td><strong>Color:</strong></td>        <td><input type='text' id='pr_color' value='" . $_REQUEST['pr_color'] . "' /></td></tr>
                
    </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposPrenda();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_pr' value='1' style='display:none'/>
    </div>";
?>
<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Editar Usuario   <img id="btnSalir" style="position:absolute;left:97.5%;margin-top:1px;" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr><td>&nbsp</td></tr>
            <tr><td>&nbsp</td></tr>
             
            <tr style='display:none;'><td>Codigo</td><td>          <input type='text' id='us_id' value='" . $_REQUEST['us_id'] . "'   /></td></tr>
            <tr><td><strong>Nombre:</strong></td><td>              <input type='text' id='us_nombre' value='" . $_REQUEST['us_nombre'] . "'   /></td></tr>
            <tr><td><strong>Mail:</strong></td><td>                <input type='text' id='us_mail' value='" . $_REQUEST['us_mail'] . "'   /></td></tr>
            <tr><td><strong>Clave:</strong></td>  <td>             <input type='text' id='us_clave' value='" . $_REQUEST['us_clave'] . "'/></td> </tr>
            <tr><td><strong>Estado:</strong></td><td>              <input type='text' id='us_estado' value='" . $_REQUEST['us_estado'] . "'   /></td></tr>
            <tr><td>&nbsp</td></tr>
            <tr><td>&nbsp</td></tr>
            </table></td>
       </tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposUsuario();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_usr' value='1' style='display:none'/>
    </div>";
?> 
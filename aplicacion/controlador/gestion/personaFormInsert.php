<?php

$pe_id=isset($_REQUEST['pe_id'])?$_REQUEST['pe_id']:null;
$pe_nombre=isset($_REQUEST['pe_nombre'])?$_REQUEST['pe_nombre']:null; 
$pe_descripcion=isset($_REQUEST['pe_descripcion'])?$_REQUEST['pe_descripcion']:null;
$opcion_pe=isset($_REQUEST['pe_id'])?1:0;
$title= isset($_REQUEST['pe_id'])?'Editar persona':'Ingresar persona';

echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.'   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div  class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>         
     <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'> 
        <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='pe_id' value='$pe_id'/></td></tr>
        <tr><td><strong>Nombre:</strong></td>       <td><input placeholder='Joven' type='text' value='$pe_nombre' id='pe_nombre' /></td></tr>
        <tr><td><strong>Descripción:</strong></td>  <td><textarea placeholder='Aqui corresponde' style='width:210px;height:150px;' rows='4' cols='26' id='pe_descripcion'> $pe_descripcion </textarea>  </td></tr>
        <tr><td colspan='2'></td></tr>
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposPersona();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_pe' value='$opcion_pe' style='display:none'/>
    </div>";
?>
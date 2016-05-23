<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Usuario   <img id="btnSalir" style="position:absolute;left:97.5%;margin-top:1px;" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
                                        
            
        <tr><td><strong>Nombre:</strong></td>       <td> <input placeholder='Náser' type='text' id='us_nombre'   value=''/></td></tr>
        <tr><td><strong>Mail:</strong></td>         <td> <input placeholder='nmora@hotmail.com' type='text' id='us_mail'   value=''/></td></tr>
        <tr><td><strong>Clave:</strong></td>        <td> <input placeholder='x' type='password' id='us_clave'  /></td> </tr>
        <tr><td><strong>Estado:</strong></td>      <td> <input placeholder='ACT/DES' type='text' id='us_estado' value=''/></td> </tr>
         
        </td></tr>
    </table>
    
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposUsuario();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_usr' value='0' style='display:none'/>
    </div>";
?>
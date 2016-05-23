//-------------------------------------------------------------------------------------------------------------------FUNCIONES GLOBALES
function soportaAjax()
{
    //Navegadores diferentes a IE (Firefox, Netscape, Opera, Safari y Opera)
    if (window.XMLHttpRequest)
    {
        request=new XMLHttpRequest();
    }
    else if (window.ActiveXObject) //Navegadores IE
    {
        request=new ActiveXObject("Msxml2.XMLHTTP");
        if(!request)
        {
            request=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    
    if(!request)
    {
        alert("Su navegador no permite el uso de todas las funcionalidades de esta aplicaci�n, por lo que podria comportarse de manera inesperada.");
        return false;
    }
    else
    {        
        return true;
    }
}

//http://www.cristalab.com/tutoriales/introduccion-a-ajax-con-php-y-formularios-c165l/

function nuevoAjax()
{ 
    var xmlhttp=false;
    try { 
        // Creación del objeto ajax para navegadores diferentes a Explorer 
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
    }
    catch (e) { 
        // o bien 
        try { 
            // Creación del objet ajax para Explorer 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) { 
            xmlhttp = false; 
        } 
    } 
    
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') { 
        xmlhttp = new XMLHttpRequest(); 
    } 
    return xmlhttp; 
} 

function vistas(url){
    $.ajax({
        url: url,
        type: 'post',
        beforeSend: function () {
            $("#detailMenu").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
        }
    });
}

/* PROVINCIA */

function irCategoriaPrenda(ca_id,ca_nombre){
    var parametros = {
        "ca_id" : ca_id,
        "ca_nombre" : ca_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admprenda.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            consPrenda(ca_id, '0');
            asignarPersona(ca_nombre);
        }
    });
} 

function consPersona(pe_id){
    var parametros = {
        "pe_id" : pe_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/personaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginPersona(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/personaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addPersona(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/personaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  
  
function validarCamposPersona() {
    var cadena = /^[a-z]+$/; 
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#pe_nombre").val() == ""){
            $("#pe_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#pe_nombre").val().length<=2  || $("#pe_nombre").val().length>31 ){
            $("#pe_nombre").focus().after("<span class='errorE'>Ingresar un valor entre [5–32 caracteres]</span>");
            return false;
        }else if($("#pe_descripcion").val() == ""){
            $("#pe_descripcion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#pe_descripcion").val().length<=2  || $("#pe_descripcion").val().length>499 ){
            $("#pe_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–500 caracteres]</span>");
            return false;
        }else{
            var opcion=$("#opcion_pe").val();
            var pe_id;
            if(opcion==0){
                insertPersona(opcion,$("#pe_nombre").val(),$("#pe_descripcion").val()); 
            }else{
                pe_id=$("#pe_id").val();
                updaPersona(opcion,pe_id,$("#pe_nombre").val(),$("#pe_descripcion").val());
            }    
        } 
    });     
    $("#pe_nombre, #pe_descripcion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function imprimeExito(mensaje){
    var divFormulario = document.getElementById('divFormulario');
    divFormulario.innerHTML = '\n\
                <div class="alert alert-success">\n\
                 <a class="close" data-dismiss="alert">  </a>\n\
                    <strong>'+"<img src='../img/ok.png'/>"+'   '+mensaje+'</strong>\n\
                </div> \n\
                </div>';
}

function imprimeError(mensaje){
    var divFormulario = document.getElementById('divFormulario');
    divFormulario.innerHTML = '\n\
                <div class="alert alert-error">\n\
                 <a class="close" data-dismiss="alert"></a>\n\
                    <strong>'+mensaje+'</strong>\n\
                </div> \n\
                </div>';
}


/*á > &aacute;
é > &eacute;
í > &iacute;
ó > &oacute;
ú > &uacute;
Á > &Aacute;
 */

function insertPersona(opcion,pe_nombre,pe_descripcion){ 
    var parametros = {
        "opcion" : opcion,
        "pe_nombre" : pe_nombre,
        "pe_descripcion" : pe_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/personaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPersona('0'); 
            $('#divFormulario').fadeOut(5000);
        }
    });
}

var strCmd;
var waitseconds;
var timeOutPeriod;
var hideTimer;

function cerrarAuto(){
    strCmd = "document.getElementById('divFormulario').style.display = 'none'";
    waitseconds = 2;
    timeOutPeriod = waitseconds * 1000;
    hideTimer = setTimeout(strCmd, timeOutPeriod);
}    

function cerrarAutoMapa(){
    strCmd = "document.getElementById('map').style.display = 'none'";
    waitseconds = 2;
    timeOutPeriod = waitseconds * 1000;
    hideTimer = setTimeout(strCmd, timeOutPeriod);
}    

function updaPersona(opcion,pe_id,pe_nombre,pe_descripcion){
    var parametros = {
        "opcion" : opcion,
        "pe_id" : pe_id,
        "pe_nombre" : pe_nombre,
        "pe_descripcion" : pe_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/personaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPersona('0');
        }
    });
}

function selecAllChkBox(chkBoxPadreId, chkBoxHijosName) {
    var arrChkBoxHijos = document.getElementsByName(chkBoxHijosName);
    var chkPadre = document.getElementById(chkBoxPadreId); 
    /* accedo solo al  elemento del  Padre */
    for (i = 0; i < arrChkBoxHijos.length; i++)
        if (chkPadre.checked)
            arrChkBoxHijos[i].checked = true;
        else
            arrChkBoxHijos[i].checked = 0;
}

function deselecChkPadre(chkBoxPadreId) {
    document.getElementById(chkBoxPadreId).checked = 0;
}

 

function editPersona(pe_id,pe_nombre,pe_descripcion,pr_capital,pr_poblacion,pr_region){
    mostrarDiv("divFormulario");
    var parametros = {
        "pe_id" : pe_id,
        "pe_nombre" : pe_nombre,
        "pe_descripcion" : pe_descripcion,
        "pr_capital" : pr_capital,
        "pr_poblacion" : pr_poblacion,
        "pr_region" : pr_region
    };
    $.ajax({
        data: parametros,
        url: 'gestion/personaFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delPersonaDesdeMenu(chkBoxHijosName) {
    var pe_id,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        if (arrChkBox[i].checked) {
            delPersona(3,arrChkBox[i].id);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delPersona(opcion,pe_id){
    var parametros = {
        "opcion" : opcion,
        "pe_id" : pe_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/personaFuncion.php',
        type: 'post',
        success: function () { 
            consPersona('0'); 
        }
    }); 
}

function changePersona(id_descripcion){
    document.getElementById('id_descripcion').innerHTML=id_descripcion;
}

/*---------------------------------------CANTON--------------------------------------*/

function asignarPersona(pe_id,pe_nombre){
    if(ca_nombre.length>=28){
        document.getElementById('pe_nombre').innerHTML=pe_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('pe_nombre').innerHTML=pe_nombre.substring(0, 28);
    }
    document.getElementById('pe_id').value=pe_id;
}

function consPrenda(ca_id,pr_id){ 
    var parametros = {
        "ca_id" : ca_id,
        "pr_id" : pr_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/prendaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginPrenda(nropagina){
    var pe_id= $("#PR_id").val();
    var ca_id=0;
    var parametros = {
        "pag" : nropagina,
        "pe_id" : pe_id,
        "ca_id" : ca_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/prendaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
 
function addPrenda(){   
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    var CA_id= $("#CA_id").val();
    var parametros = {
        "CA_id" : CA_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/prendaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposPrenda(){ 
    var ca_id=  $("#ca_id").val();
    var pe_id=  $("#pe_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove(); 
        if($("#pr_nombre").val() == ""){
            $("#pr_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        } else if($("#pr_nombre").val().length<=2  || $("#pr_nombre").val().length>124){
            $("#pr_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–125 caracteres]</span>");
            return false;
        }else if($("#pr_material").val() == "" ){
            $("#pr_material").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#pr_material").val().length<=2  || $("#pr_material").val().length>254){
            $("#pr_material").focus().after("<span class='errorE'>Ingrese un valor [5–255 caracteres]</span>");
            return false;
        } else if($("#pr_precio").val() == ""){
            $("#pr_precio").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#pr_precio").val().length<=2  || $("#pr_precio").val().length>31){
            $("#pr_precio").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres] </span>");
            return false;
        } else if($("#pr_talla").val() == ""){
            $("#pr_talla").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#pr_talla").val().length<=2  || $("#pr_talla").val().length>63){
            $("#pr_talla").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres] </span>");
            return false;
        } else if($("#pr_color").val() == ""){
            $("#pr_color").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#pr_color").val().length<=2  || $("#pr_color").val().length>63){
            $("#pr_color").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres] </span>");
            return false;
        }
        else if($("#pe_id").val()==""){
            $("#pe_id").focus().after("<span class='errorE'>Seleccione una Persona </span>");
            return false;
        }
        else{
            var opcion=$("#opcion_pr").val();// document.getElementById('opcion_pr').value;
            var pr_id;
            if(opcion==0){
                insertPrenda(opcion,ca_id,pe_id,$("#pr_nombre").val(),$("#pr_material").val(),$("#pr_precio").val(),$("#pr_talla").val(),$("#pr_color").val()); 
            }else{
                pr_id=$("#pr_id").val();
                updaPrenda(opcion,ca_id,pe_id,pr_id,$("#pr_nombre").val(),$("#pr_material").val(),$("#pr_precio").val(),$("#pr_talla").val(),$("#pr_color").val());
            }
        }
    });     
    $("#pr_nombre, #pr_material, #pr_precio, #pr_talla, #pr_color").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}
   
function insertPrenda(opcion,ca_id,pe_id,pr_nombre,pr_material,pr_precio,pr_talla,pr_color){
    //alert(opcion+','+ca_id+','+pe_id+','+pr_nombre+','+pr_material+','+pr_precio+','+pr_talla+','+pr_color);
    var parametros = {
        "opcion" : opcion, 
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_nombre" : pr_nombre,
        "pr_material" : pr_material,
        "pr_precio" : pr_precio,
        "pr_talla" : pr_talla,
        "pr_color" : pr_color
    };
    $.ajax({
        data: parametros,
        url: 'gestion/prendaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPrenda(ca_id, '0');
            cerrarAuto(); 
        }
    });
}

function updaPrenda(opcion,ca_id,pe_id,pr_id,pr_nombre,pr_material,pr_precio,pr_talla,pr_color){
    //alert(ca_id+','+pe_id+','+pr_id+','+ pr_nombre+','+pr_material+','+pr_precio+','+pr_talla+','+pr_color);
    var parametros = {
        "opcion" : opcion,
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_id" : pr_id,
        "pr_nombre" : pr_nombre,
        "pr_material" : pr_material,
        "pr_precio" : pr_precio,
        "pr_talla" : pr_talla,
        "pr_color" : pr_color
    };
    $.ajax({
        data: parametros,
        url: 'gestion/prendaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consPrenda(ca_id, '0');
        }
    });
}

function editPrenda(ca_id,pe_id,pr_id,pr_nombre,pr_material,pr_precio,pr_talla,pr_color){
    //alert(ca_id+','+pe_id+','+pr_id+','+pr_nombre+','+pr_material+','+pr_precio+','+pr_talla+','+pr_color);
    mostrarDiv("divFormulario");
    var parametros = {
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_id" : pr_id,
        "pr_nombre" : pr_nombre,
        "pr_material" : pr_material,
        "pr_precio" : pr_precio,
        "pr_talla" : pr_talla,
        "pr_color" : pr_color
    };
    $.ajax({
        data: parametros,
        url: 'gestion/prendaFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
 

function delPrenda(opcion,ca_id,pr_id){  
    var parametros = {
        "opcion" : opcion,
        "ca_id" : ca_id,
        "pr_id" : pr_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/prendaFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consPrenda(ca_id, '0');
        }
    });     
}

function changePrenda(id_descripcion){
    document.getElementById('id_descripcion').innerHTML=id_descripcion;
}

/* Categoria*/


function consCategoria(ca_id){
    var parametros = {
        "ca_id" : ca_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/categoriaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function consCatAdm(ca_id){
    //alert("S");
    var parametros = {
        "ca_id" : ca_id
    };
    // ../../../controlador/gestion/
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/categoriaConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
} 

function PaginCategoriaAdm(nropagina){
    var parametros = {
        "pag" : nropagina,
        "ca_id":0
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/categoriaConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
    
}

function PaginCategoria(nropagina){ 
    var ca_id=0;
    var parametros = {
        "pag" : nropagina,
        "ca_id":ca_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/categoriaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function consContador(id){
    var parametros = {
        "id" : id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/contadorCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
 
function PaginContador(nropagina){
    var id=0;
    var parametros = {
        "pag" : nropagina,
        "id" : id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/contadorCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function delContadorDesdeMenu(chkBoxHijosName) {
    var ca_id,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        //pe_id = document.getElementById('pe_id' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            delContador(3,arrChkBox[i].id);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delContador(opcion,id){
    var parametros = {
        "opcion" : opcion,
        "id" : id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/contadorFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consContador('0');
        }
    });
}

function addCategoria(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:55px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
     
    $.ajax({
        url: 'gestion/categoriaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delCatAdm(opcion,ca_id){
    var parametros = {
        "opcion" : opcion,
        "ca_id" : ca_id
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/categoriaFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consCatAdm('0');
        }
    }); 
}

function consFoto(ca_id,pe_id,pr_id,fo_id){
    var parametros = {
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_id" : pr_id,
        "fo_id" : fo_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/fotoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function PaginFoto(nropagina){ 
    var ca_id= $("#CA_id").val();
    var pe_id= $("#PE_id").val();
    var pr_id= $("#PR_id").val(); 
    var parametros = {
        "pag" : nropagina,
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_id" : pr_id,
        "fo_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/fotoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function consFotoAdm(ca_id,pe_id,pr_id,fo_id){
    var parametros = {
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_id" : pr_id,
        "fo_id" : fo_id
    };
    // ../../../controlador/gestion/
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/fotoConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
} 

function PaginFotoAdm(nropagina){ 
    var ca_id= $("#CA_id").val();
    var pe_id= $("#PE_id").val();
    var pr_id= $("#PR_id").val();
    //var fo_id= $("#FO_id").val();
    var parametros = {
        "pag" : nropagina,
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_id" : pr_id,
        "fo_id" : 0
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/fotoConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
}
 
function validarFotos(mensaje){ 
    var divFormulario = document.getElementById('error');
    divFormulario.innerHTML = '\n\
                <div class="alert alert-message">\n\
                 <a class="close" data-dismiss="alert">  </a>\n\
                    <strong>'+"<img src='../img/ok.png'/>"+'   '+mensaje+'</strong>\n\
                </div> \n\
                </div>';
} 

function validarCamposFoto(){
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#fo_nombre").val() == ""){
            $("#fo_nombre").focus().after("<span class='errorE'>Este campo es requerido.  </span>");
            return false;
        } else if($("#fo_fecha").val() == ""){
            $("#fo_fecha").focus().after("<span class='errorE'>Este campo es requerido.  </span>");
            return false;
        } else if($("#fo_descripcion").val().length<=2 || $("#fo_descripcion").val().length>31){
            $("#fo_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres]</span>");
            return false;
        }
        else if($("#archivo").val() == ""){
            $("#archivo").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        } else{ 
        //alert("SSSS"); 
        }
    });
    
    $("#fo_nombre, #fo_descripcion, #archivo").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}
function delFotoAdm(opcion,ca_id,pe_id,pr_id,fo_id){
    var parametros = {
        "opcion" : opcion,
        "ca_id" : ca_id,
        "pe_id" : pe_id,
        "pr_id" : pr_id,
        "fo_id" : fo_id
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/fotoFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consFotoAdm(ca_id, pe_id, pr_id, 0);
        }
    }); 
}

function selectCategoriaPrenda(ca_id,pr_id){
    var i=0; 
    var elemento='';
    var texto='';
    var ancla=''; 
    $.getJSON('gestion/selectCategoriaPrenda.php', {
        ca_id: ca_id,
        pr_id: pr_id
    }, function(data) {
        var ul=document.getElementById('dropdown-menu');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][3]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consFoto("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+0+'");asignarPrenda("'+data[i][3]+'");');
                ul.appendChild(elemento);
            }
        }
    });
}

function asignarPrenda(pr_nombre){
    if(ca_nombre.length>=18){
        document.getElementById('pr_nombre').innerHTML=pr_nombre.substring(0, 18)+'.';
    }else{
        document.getElementById('pr_nombre').innerHTML=pr_nombre.substring(0, 18);
    } 
} 

function asignarCategoria(ca_nombre){
    if(ca_nombre.length>=28){
        document.getElementById('ca_nombre').innerHTML=ca_nombre.substring(0, 28)+'.';
    }else{
        document.getElementById('ca_nombre').innerHTML=ca_nombre.substring(0, 28);
    }
}

function selectPersonaPrenda_tri(pe_id,pe_nombre,consulta){
    var i=0; 
    var elemento='';
    var texto='';
    var ancla=''; 
    //var encoded = JSON.stringify(data);
    $.getJSON('gestion/selectPersonaPrenda.php', {
        pe_id: pe_id,
        pe_nombre: pe_nombre
    }, function(data) {
        var ul=document.getElementById('dropdown-menu_doble');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][2]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:selectPrendaSitio_tri("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+consulta+'");asignarPrenda("'+data[i][2]+'");');
                ul.appendChild(elemento);
            }
        }
    });
}


/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*ADMINISTRACION*/

function consUsuario(us_id){
    var parametros = {
        "us_id" : us_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function PaginUsuario(nropagina){
    var parametros = {
        "pag" : nropagina,
        "us_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addUsuario(){
    document.getElementById("divFormulario").setAttribute('style', 'left:35%;display:block; top:55px;width:63%;height:75%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/usuarioFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposUsuario(){    
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    $("#botonn").ready(function (){
        $(".errorE").remove();                 
        if($("#us_nombre").val() == ""){
            $("#us_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#us_nombre").val().length<=2  || $("#us_nombre").val().length>31){
            $("#us_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres]</span>");
            return false;
        }
        else if($("#us_mail").val() == "" ){
            $("#us_mail").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if(!emailreg.test($("#us_mail").val()) ){
            $("#us_mail").focus().after("<span class='errorE'>Ingrese un email válido!.</span>");
            return false;
        }
        else if($("#us_mail").val().length<=2 || $("#us_mail").val().length>23){
            $("#us_mail").focus().after("<span class='errorE'>Ingrese un valor [5–24 caracteres]</span>");
            return false;
        } 
        else if($("#us_clave").val() == "" ){
            $("#us_clave").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#us_clave").val().length<=2 || $("#us_clave").val().length>14){
            $("#us_clave").focus().after("<span class='errorE'>Ingrese un valor [5–15 caracteres]</span>");
            return false;
        }
        else if($("#us_estado").val() == "" ){
            $("#us_estado").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#us_estado").val().length<=1  || $("#us_estado").val().length>4){
            $("#us_estado").focus().after("<span class='errorE'>Ingrese un valor [1–5 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_usr").val();
            var us_id;
            if(opcion==0){
                insertUsuario(opcion,$("#us_nombre").val(),$("#us_mail").val(),$("#us_clave").val(),$("#us_estado").val()); 
            }else{
                us_id=$("#us_id").val();
                updaUsuario(opcion,us_id,$("#us_nombre").val(),$("#us_mail").val(),$("#us_clave").val(),$("#us_estado").val());
            }    
        }
    });
    
    $("#us_nombre, #us_mail, #us_clave, #us_estado").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertUsuario(opcion,us_nombre,us_mail,us_clave,us_estado){
    var parametros = {
        "opcion" : opcion,
        "us_nombre" : us_nombre,
        "us_mail" : us_mail,
        "us_clave" : us_clave,
        "us_estado" : us_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            imprimeExito(response);
            consUsuario('0');
            cerrarAuto();
        }
    });
}

function updaUsuario(opcion,us_id,us_nombre,us_mail,us_clave,us_estado){
    var parametros = {
        "opcion" : opcion, 
        "us_id" : us_id,
        "us_nombre" : us_nombre, 
        "us_mail" : us_mail, 
        "us_clave" : us_clave,
        "us_estado" : us_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consUsuario('0');
            cerrarAuto();
        }
    });
}

function editUsuarioDesdeMenu(chkBoxHijosName) {
    var em_id,us_id, us_nombre,us_apellido,us_mail,us_usuario,us_clave,us_estado,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        us_id = document.getElementById('us_id' + i).innerHTML;
        us_nombre = document.getElementById('us_nombre' + i).innerHTML;
        us_apellido = document.getElementById('us_apellido' + i).innerHTML;
        us_mail = document.getElementById('us_mail' + i).innerHTML;
        us_usuario= document.getElementById('us_usuario' + i).innerHTML;
        us_clave= document.getElementById('us_clave' + i).innerHTML;
        us_estado= document.getElementById('us_estado' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            editUsuario(arrChkBox[i].id,us_id,us_nombre,us_apellido,us_mail,us_usuario,us_clave,us_estado);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Usuario !!");
    }
}

function editUsuario(us_id,us_nombre,us_mail,us_clave,us_estado){
    mostrarDiv("divFormulario");
    var parametros = { 
        "us_id" : us_id,
        "us_nombre" : us_nombre, 
        "us_mail" : us_mail, 
        "us_clave" : us_clave,
        "us_estado" : us_estado
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delUsuarioDesdeMenu(chkBoxHijosName) {
    var usId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        usId = document.getElementById('usId' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            delUsuario(3,arrChkBox[i].id,usId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delUsuario(opcion,us_id){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consUsuario('0');
        }
    }); 
}

function irUsuarioRol(us_id,us_nombre){
    var parametros = {
        "us_id" : us_id,
        "us_nombre" : us_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admrol.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            consRol(us_id, '0');
            asignarUsuario(us_nombre);
        }
    });
} 

function asignarUsuario(us_nombre){
    document.getElementById('us_nombre').innerHTML=us_nombre;
}

/*Rol*/

function consRol(us_id,ro_id){
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginRol(nropagina){
    var us_id= $("#US_id").val();
    var parametros = {
        "pag" : nropagina,
        "us_id" : us_id,
        "ro_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}  

function addRol(){
    mostrarDiv("divFormulario");
    var US_id= $("#US_id").val();
    var parametros = {
        "us_id" : US_id 
    }; 
    $.ajax({
        data: parametros,
        url: 'gestion/rolFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposRol(){
    var us_id=$("#US_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove();    
        if($("#ro_nombre").val() == ""){
            $("#ro_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#ro_nombre").val().length<=2  || $("#ro_nombre").val().length>19){
            $("#ro_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–20 caracteres]</span>");
            return false;
        }else if($("#ro_descripcion").val() == "" ){
            $("#ro_descripcion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#ro_descripcion").val().length<=2  || $("#ro_descripcion").val().length>63){
            $("#ro_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_rol").val();
            var ro_id;
            if(opcion==0){
                insertRol(opcion,us_id,$("#ro_nombre").val(),$("#ro_descripcion").val()); 
            }else{
                ro_id=$("#ro_id").val();
                updaRol(opcion,us_id,ro_id,$("#ro_nombre").val(),$("#ro_nombre").val());
            }    
        }
    });
    
    $("#ro_nombre, #ro_descripcion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertRol(opcion,us_id,ro_nombre,ro_descripcion){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "ro_nombre" : ro_nombre,
        "ro_descripcion" : ro_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFuncion.php',
        type: 'post',
        beforeSend: function () {
        //  $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consRol(us_id, '0');
            cerrarAuto();
        }
    });
}

function updaRol(opcion,us_id,ro_id,ro_nombre,ro_descripcion){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre,
        "ro_descripcion" : ro_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consRol(us_id, '0');
        }
    });
}

function editRolDesdeMenu(chkBoxHijosName) {
    var em_id,us_id,ro_id, ro_nombre,ro_descripcion,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) { 
        us_id = document.getElementById('us_id' + i).innerHTML;
        ro_id = document.getElementById('ro_id' + i).innerHTML; 
        ro_nombre = document.getElementById('ro_nombre' + i).innerHTML;
        ro_descripcion = document.getElementById('ro_descripcion' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            editRol(arrChkBox[i].id,us_id,ro_id,ro_nombre,ro_descripcion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Rol !!");
    }
}

function editRol(us_id,ro_id,ro_nombre,ro_descripcion){
    mostrarDiv("divFormulario");
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre,
        "ro_descripcion" : ro_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
 
function delRolDesdeMenu(chkBoxHijosName) {
    var em_id,usId,roid,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        usId = document.getElementById('usId' + i).innerHTML;
        roId = document.getElementById('roId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delRol(3,arrChkBox[i].id,usId,roId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delRol(opcion,us_id,ro_id){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "ro_id" : ro_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consRol(us_id, '0');
        }
    }); 
}

/*Modulo*/

function selectUsuarioRol(us_id,ro_id){
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectUsuarioRol.php', {
        us_id: us_id,
        ro_id: ro_id
    }, function(data) {
        var ul=document.getElementById('dropdown-menu');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][2]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consResponsabilidad("'+data[i][0]+'","'+data[i][1]+'","'+0+'");asignarRol("'+data[i][2]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function asignarRol(ro_nombre){
    document.getElementById('ro_nombre').innerHTML = ro_nombre.toString();
}

function consResponsabilidad(us_id,ro_id,re_id){
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginRespon(nropagina){
    var em_id=$("#EM_id").val();
    var us_id=$("#US_id").val();
    var ro_id=$("#RO_id").val();
    var parametros = {
        "pag" : nropagina,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addResponsabilidad(){
    mostrarDiv("divFormulario");
    var US_id=$("#US_id").val();
    var RO_id=$("#RO_id").val();
    
    var parametros = {
        "us_id" : US_id,
        "ro_id" : RO_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposResponsabilidad(){
    var us_id=  $("#re_us_id").val();
    var ro_id=  $("#re_ro_id").val();    
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#re_nombre").val() == "" ){
            $("#re_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#re_nombre").val().length<=2  || $("#re_nombre").val().length>19){
            $("#re_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–20 caracteres]</span>");
            return false;
        }
        else if($("#re_descripcion").val() == ""){
            $("#re_descripcion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        } 
        else if($("#re_descripcion").val().length<=2  || $("#re_descripcion").val().length>63){
            $("#re_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_resp").val();
            if(opcion==0){
                insertResponsabilidad(opcion,us_id,ro_id,$("#re_nombre").val(),$("#re_descripcion").val());
            }
            else{
                var re_id=$("#re_re_id").val();
                updaResponsabilidad(opcion,us_id,ro_id,re_id,$("#re_nombre").val(),$("#re_descripcion").val());
            }
        }
    });
    
    $("#re_nombre, #re_descripcion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}

function insertResponsabilidad(opcion,us_id,ro_id,re_nombre,re_descripcion){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id, 
        "ro_id" : ro_id,
        "re_nombre" : re_nombre,
        "re_descripcion" : re_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFuncion.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            //alert(response);
            consResponsabilidad(us_id, ro_id, '0');
            cerrarAuto();
        }
    });
}

function updaResponsabilidad(opcion,us_id,ro_id,re_id,re_nombre,re_descripcion){
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id,
        "re_nombre" : re_nombre,
        "re_descripcion" : re_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consResponsabilidad(em_id, us_id, ro_id, '0');
        }
    });
}

function editResponsabilidadDesdeMenu(chkBoxHijosName) {
    var em_id,us_id,ro_id ,re_id, re_nombre,re_descripcion,checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        us_id = document.getElementById('us_id' + i).innerHTML;
        ro_id = document.getElementById('ro_id' + i).innerHTML;
        re_id = document.getElementById('re_id' + i).innerHTML;
        re_nombre = document.getElementById('re_nombre' + i).innerHTML;
        re_descripcion = document.getElementById('re_descripcion' + i).innerHTML;
        if (arrChkBox[i].checked) {
            editResponsabilidad(arrChkBox[i].id,us_id,ro_id, re_id,re_nombre,re_descripcion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Responsabilidad !!");
    }
}

function editResponsabilidad(us_id,ro_id,re_id,re_nombre,re_descripcion){
    mostrarDiv("divFormulario");
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id,
        "re_nombre" : re_nombre,
        "re_descripcion" : re_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delResponsabilidadDesdeMenu(chkBoxHijosName) {
    var es_id,usId,roId,reId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        usId = document.getElementById('usId' + i).innerHTML;
        roId = document.getElementById('roId' + i).innerHTML;
        reId = document.getElementById('reId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delResponsabilidad(3,arrChkBox[i].id,usId,roId,reId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delResponsabilidad(opcion,us_id,ro_id,re_id){  
    var parametros = {
        "opcion" : opcion,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consResponsabilidad(us_id, ro_id, '0');
        }
    });     
}
function irRolResponsabilidad(us_id,ro_id,ro_nombre){
    var us_nombre=document.getElementById('us_nombre').innerHTML;
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admresponsabilidad.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            selectUsuarioRol(us_id, ro_id);
            asignarUsuario(us_nombre);
            consResponsabilidad(us_id, ro_id, '0');
            asignarRol(ro_nombre) 
        }
    });
} 

/*PANTALLAS*/

function asignarResponsabilidad(re_nombre){
    document.getElementById('re_nombre').innerHTML=re_nombre;
}

function selectUsuarioRol_pantalla(us_id,us_nombre){
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectUsuarioRol.php', {
        us_id: us_id,
        us_nombre: us_nombre
    }, function(data) {
        var ul=document.getElementById('dropdown-menu_doble');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][2]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consRolResponsabilidad_pantalla("'+data[i][0]+'","'+data[i][1]+'","'+0+'");asignarRol("'+data[i][2]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function consRolResponsabilidad_pantalla(us_id,ro_id,ro_nombre){
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectRolResponsabilidad.php', {
        us_id: us_id,
        ro_id: ro_id,
        ro_nombre: ro_nombre
    }, function(data) {
        var ul=document.getElementById('dropdown-menu_triple');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][3]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href','javascript:consPantalla("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+0+'");asignarResponsabilidad("'+data[i][3]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function consPantalla(us_id,ro_id,re_id,pa_id){
    var parametros = {
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id,
        "pa_id" : pa_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pantallaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function activarChkBox(nameChkBox) {
    var arreglock = document.getElementsByName(nameChkBox);
    for (i = 0; i < arreglock.length; i++)
        arreglock[i].removeAttribute("disabled");
    var chkpadre=document.getElementById('chkPadreRol'); 
    if(chkpadre)
        chkpadre.removeAttribute("disabled");
}

function consultarPantallasAsignadas() {
    var p_us_id=  $("#PA_us_id").val();
    var p_ro_id=  $("#PA_ro_id").val();
    var p_re_id=  $("#PA_re_id").val();
    $.getJSON('gestion/pantallaSelect.php', {
        p_us_id: p_us_id,
        p_ro_id: p_ro_id,
        p_re_id: p_re_id
    } ,function(data) {
        marcarChkBox("chkHijoRol", data);
    });
}

function marcarChkBox(chkBoxName, elementSelecteds) {
    var listChkBox = document.getElementsByName(chkBoxName);
    for (i = 0; i < elementSelecteds.length; i++) {
        for (j = 0; j < listChkBox.length; j++)
            if (elementSelecteds[i] == listChkBox[j].id)
                listChkBox[j].checked = true;
    }
} 
function closer() { 
    /*$.ajax({
        url: 'exit.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            
        }
    });    */
    var ventana = window.self;
    ventana.opener = window.self;
    ventana.close();
}
function insertarPantallas() {
    var arrPanSelected = new Array();
    var arrChkBox = new Array();
    var j = 0;
    var usu,rol, res ,pt_id, pt_nombre, pt_descripcion;
    arrChkBox = document.getElementsByName('chkHijoRol');    
    for (i = 0; i <arrChkBox.length; i++) { 
        usu = document.getElementById('pt_us_id' + i).innerHTML;
        rol = document.getElementById('pt_ro_id' + i).innerHTML;
        res = document.getElementById('pt_re_id' + i).innerHTML;
        pt_id = document.getElementById('pt_id' + i).innerHTML;
        pt_nombre = document.getElementById('pt_nom' + i).innerHTML;
        pt_descripcion = document.getElementById('pt_des' + i).innerHTML;
        if (arrChkBox[i].checked) {
            //alert(usu+','+rol+','+res+','+pt_id+','+pt_nombre+','+pt_descripcion); 
            arrPanSelected[j] = [usu.toString(),rol.toString(),res.toString(),pt_id.toString(),pt_nombre.toString(),pt_descripcion.toString()];
            j++;
        }else
        {
            eliminarPantalla(usu,rol, res ,pt_id);
            j++;
        }
    }
    
    var	ajaxGuardarPantallas = nuevoAjax();
    ajaxGuardarPantallas.onreadystatechange = function() {
        if (ajaxGuardarPantallas.readyState == 4)
            if (ajaxGuardarPantallas.responseText) {
                alert(ajaxGuardarPantallas.responseText);
                document.getElementById('resultadoPantalla').innerHTML = ajaxGuardarPantallas.responseText;
            }
            else{ 
                document.getElementById('resultadoPantalla').innerHTML = "<img src='img/loading2.gif' /> Cargando...";
            }
    };
    ajaxGuardarPantallas.open('post', 'gestion/pantallaInsert.php', true);
    ajaxGuardarPantallas.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajaxGuardarPantallas.send(returnGuardarPantallas(arrPanSelected, arrChkBox));
    ComprobarSeleCheckHijos(); // comprobamos en el caso de que no tengamos
}

function returnGuardarPantallas(arrPanSelected, arrChkBox) {
    var cad = '';
    cad = 'arrPanSelected='+ encodeURIComponent(JSON.stringify(arrPanSelected)) + '&arrChkBox=' + encodeURIComponent(JSON.stringify(arrChkBox));
    return cad;
}

function eliminarPantalla(usu,rol, res ,pt_id) {
    var parametros = {
        "usu" : usu,
        "rol" : rol,
        "res" : res,
        "pt_id" : pt_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pantallaDel.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
        }
    });     
} 

function ComprobarSeleCheckHijos(){
    var arrChkBox = document.getElementsByName('chkHijoRol');
    var cont=0;
    for (i = 0; i < arrChkBox.length; i++) {
        if (arrChkBox[i].checked==1)
            cont++;
    }
    if(cont>0){
    //mostrarMensaje("Cambios Realizados");
    }
}

function DesactivarChkBox(){
    document.getElementById('chkPadreRol').disabled='disabled';
    var arreglochekHijo = document.getElementsByName('chkHijoRol');
    for (i = 0; i < arreglochekHijo.length; i++)
        arreglochekHijo[i].disabled='disabled';
}

/*-----------------------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------*/

/*Login*/
function asignarRolLogin(ro_id,ro_nombre){
    document.getElementById('ro_id').value=ro_id;
    document.getElementById('ro_nombre').innerHTML=ro_nombre;
}

function obtenerValores(vector){
    var vec = new Array();
    for ( var i = 0; i < vector.length; i++) {
        vec [i] = document.getElementById(vector[0]).value;
    }
    return vec;
}

/*******************************************************************************
 * Para mostrar y cerrar combos al dar click
 ******************************************************************************/
 
var JSON;
if (!JSON) {
    JSON = {};
}

(function() {
    'use strict';
    function f(n) {
        // Format integers to have at least two digits.
        return n < 10 ? '0' + n : n;
    }
    if (typeof Date.prototype.toJSON !== 'function') {
        Date.prototype.toJSON = function(key) {
            return isFinite(this.valueOf()) ? this.getUTCFullYear() + '-'
            + f(this.getUTCMonth() + 1) + '-' + f(this.getUTCDate())
            + 'T' + f(this.getUTCHours()) + ':'
            + f(this.getUTCMinutes()) + ':' + f(this.getUTCSeconds())
            + 'Z' : null;
        };
        
        String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function(
            key) {
            return this.valueOf();
        };
    }
    
    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, gap, indent, meta = { // table
        // of
        // character
        // substitutions
        '\b' : '\\b',
        '\t' : '\\t',
        '\n' : '\\n',
        '\f' : '\\f',
        '\r' : '\\r',
        '"' : '\\"',
        '\\' : '\\\\'
    }, rep;
    
    function quote(string) {
        // If the string contains no control characters, no quote characters,
        // and no
        // backslash characters, then we can safely slap some quotes around it.
        // Otherwise we must also replace the offending characters with safe
        // escape
        // sequences.
        
        escapable.lastIndex = 0;
        return escapable.test(string) ? '"'
        + string.replace(escapable,
            function(a) {
                var c = meta[a];
                return typeof c === 'string' ? c : '\\u'
                + ('0000' + a.charCodeAt(0).toString(16))
                .slice(-4);
            }) + '"' : '"' + string + '"';
    }
    function str(key, holder) {
        // Produce a string from holder[key].
        var i, // The loop counter.
        k, // The member key.
        v, // The member value.
        length, mind = gap, partial, value = holder[key];
        // If the value has a toJSON method, call it to obtain a replacement
        // value.
        if (value && typeof value === 'object'
            && typeof value.toJSON === 'function') {
            value = value.toJSON(key);
        }
        // If we were called with a replacer function, then call the replacer to
        // obtain a replacement value.
        if (typeof rep === 'function') {
            value = rep.call(holder, key, value);
        }
        // What happens next depends on the value's type.
        switch (typeof value) {
            case 'string':
                return quote(value);
            case 'number':
                
                // JSON numbers must be finite. Encode non-finite numbers as null.
                return isFinite(value) ? String(value) : 'null';
            case 'boolean':
            case 'null':
                // If the value is a boolean or null, convert it to a string. Note:
                // typeof null does not produce 'null'. The case is included here in
                // the remote chance that this gets fixed someday.
                return String(value);
            // If the type is 'object', we might be dealing with an object or an
            // array or
            // null.
            case 'object':
                // Due to a specification blunder in ECMAScript, typeof null is
                // 'object',
                // so watch out for that case.
                if (!value) {
                    return 'null';
                }
                // Make an array to hold the partial results of stringifying this
                // object value.
                gap += indent;
                partial = [];
                // Is the value an array?
                if (Object.prototype.toString.apply(value) === '[object Array]') {
                    // The value is an array. Stringify every element. Use null as a
                    // placeholder
                    // for non-JSON values.
                    length = value.length;
                    for (i = 0; i < length; i += 1) {
                        partial[i] = str(i, value) || 'null';
                    }
                    // Join all of the elements together, separated with commas, and
                    // wrap them in
                    // brackets.
                    
                    v = partial.length === 0 ? '[]' : gap ? '[\n' + gap
                    + partial.join(',\n' + gap) + '\n' + mind + ']' : '['
                    + partial.join(',') + ']';
                    gap = mind;
                    return v;
                }
                // If the replacer is an array, use it to select the members to be
                // stringified.
                if (rep && typeof rep === 'object') {
                    length = rep.length;
                    for (i = 0; i < length; i += 1) {
                        if (typeof rep[i] === 'string') {
                            k = rep[i];
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                } else {
                    // Otherwise, iterate through all of the keys in the object.
                    for (k in value) {
                        if (Object.prototype.hasOwnProperty.call(value, k)) {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                }
                // Join all of the member texts together, separated with commas,
                // and wrap them in braces.
                v = partial.length === 0 ? '{}' : gap ? '{\n' + gap
                + partial.join(',\n' + gap) + '\n' + mind + '}' : '{'
                + partial.join(',') + '}';
                gap = mind;
                return v;
        }
    }
    // If the JSON object does not yet have a stringify method, give it one.
    if (typeof JSON.stringify !== 'function') {
        JSON.stringify = function(value, replacer, space) {
            // The stringify method takes a value and an optional replacer, and
            // an optional
            // space parameter, and returns a JSON text. The replacer can be a
            // function
            // that can replace values, or an array of strings that will select
            // the keys.
            // A default replacer method can be provided. Use of the space
            // parameter can
            // produce text that is more easily readable.
            var i;
            gap = '';
            indent = '';
            // If the space parameter is a number, make an indent string
            // containing that
            // many spaces.
            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' ';
                }
            // indent string.
            } else if (typeof space === 'string') {
                indent = space;
            }
            // If there is a replacer, it must be a function or an array.
            // Otherwise, throw an error.
            rep = replacer;
            if (replacer
                && typeof replacer !== 'function'
                && (typeof replacer !== 'object' || typeof replacer.length !== 'number')) {
                throw new Error('JSON.stringify');
            }
            // Make a fake root object containing our value under the key of ''.
            // Return the result of stringifying the value.
            return str('', {
                '' : value
            });
        };
    }
    // If the JSON object does not yet have a parse method, give it one.
    if (typeof JSON.parse !== 'function') {
        JSON.parse = function(text, reviver) {
            // The parse method takes a text and an optional reviver function,
            // and returns
            // a JavaScript value if the text is a valid JSON text.
            var j;
            function walk(holder, key) {
                // The walk method is used to recursively walk the resulting
                // structure so
                // that modifications can be made.
                var k, v, value = holder[key];
                if (value && typeof value === 'object') {
                    for (k in value) {
                        if (Object.prototype.hasOwnProperty.call(value, k)) {
                            v = walk(value, k);
                            if (v !== undefined) {
                                value[k] = v;
                            } else {
                                delete value[k];
                            }
                        }
                    }
                }
                return reviver.call(holder, key, value);
            }
            // Parsing happens in four stages. In the first stage, we replace
            // certain
            // Unicode characters with escape sequences. JavaScript handles many
            // characters
            // incorrectly, either silently deleting them, or treating them as
            // line endings.
            text = String(text);
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx,
                    function(a) {
                        return '\\u'
                        + ('0000' + a.charCodeAt(0).toString(16))
                        .slice(-4);
                    });
            }
            // In the second stage, we run the text against regular expressions
            // that look
            // for non-JSON patterns. We are especially concerned with '()' and
            // 'new'
            // because they can cause invocation, and '=' because it can cause
            // mutation.
            // But just to be safe, we want to reject all unexpected forms.
            // We split the second stage into 4 regexp operations in order to
            // work around
            // crippling inefficiencies in IE's and Safari's regexp engines.
            // First we
            // replace the JSON backslash pairs with '@' (a non-JSON character).
            // Second, we
            // replace all simple value tokens with ']' characters. Third, we
            // delete all
            // open brackets that follow a colon or comma or that begin the
            // text. Finally,
            // we look to see that the remaining characters are only whitespace
            // or ']' or
            // ',' or ':' or '{' or '}'. If that is so, then the text is safe
            // for eval.
            if (/^[\],:{}\s]*$/
                .test(text
                    .replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
                    .replace(
                        /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
                        ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                // In the third stage we use the eval function to compile the
                // text into a
                // JavaScript structure. The '{' operator is subject to a
                // syntactic ambiguity
                // in JavaScript: it can begin a block or an object literal. We
                // wrap the text
                // in parens to eliminate the ambiguity.
                j = eval('(' + text + ')');
                // In the optional fourth stage, we recursively walk the new
                // structure, passing
                // each name/value pair to a reviver function for possible
                // transformation.
                return typeof reviver === 'function' ? walk({
                    '' : j
                }, '') : j;
            }
            // If the text is not JSON parseable, then a SyntaxError is thrown.
            throw new SyntaxError('JSON.parse');
        };
    }
}());
 
function ocultarDiv(div) {
    document.getElementById(div).style.display = 'none';
}

function mostrarDiv(div) {
    document.getElementById(div).style.display = 'block';
}

/*--------------------- Usuarios ---------------------*/

function carga()
{
    posicion=0;
    if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
    else navegador=1;
}

function evitaEventos(event)
{
    if(navegador==0)
    {
        window.event.cancelBubble=true;
        window.event.returnValue=false;
    }
    if(navegador==1) event.preventDefault();
}

function comienzoMovimiento(event, id)
{
    elMovimiento=document.getElementById(id);
    if(navegador==0)
    {
        cursorComienzoX=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
        cursorComienzoY=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
        document.attachEvent("onmousemove", enMovimiento);
        document.attachEvent("onmouseup", finMovimiento);
    }
    if(navegador==1)
    {
        cursorComienzoX=event.clientX+window.scrollX;
        cursorComienzoY=event.clientY+window.scrollY;
        document.addEventListener("mousemove", enMovimiento, true);
        document.addEventListener("mouseup", finMovimiento, true);
    }
    elComienzoX=parseInt(elMovimiento.style.left);
    elComienzoY=parseInt(elMovimiento.style.top);
    elMovimiento.style.zIndex=++posicion;
    evitaEventos(event);
}

function enMovimiento(event)
{
    var xActual, yActual;
    if(navegador==0)
    {
        xActual=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
        yActual=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
    }
    if(navegador==1)
    {
        xActual=event.clientX+window.scrollX;
        yActual=event.clientY+window.scrollY;
    }
    elMovimiento.style.left=(elComienzoX+xActual-cursorComienzoX)+"px";
    elMovimiento.style.top=(elComienzoY+yActual-cursorComienzoY)+"px";
    evitaEventos(event);
}

function finMovimiento()
{
    if(navegador==0)
    {
        document.detachEvent("onmousemove", enMovimiento);
        document.detachEvent("onmouseup", finMovimiento);
    }
    if(navegador==1)
    {
        document.removeEventListener("mousemove", enMovimiento, true);
        document.removeEventListener("mouseup", finMovimiento, true);
    }
}
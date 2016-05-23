 
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

function nuevoAjax()
{ 
    var xmlhttp=false;
    try { 
        // Creación del objeto ajax para navegadores diferentes a Explorer 
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
    } catch (e) { 
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

var map; 
var point_layer;
var osm;
var mapQuest;
var editingControl;
var modifyControl ;
var pointLayer ;

function init() {
  
    arrayOSM = ["http://otile1.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg",
    "http://otile2.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg",
    "http://otile3.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg",
    "http://otile4.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg"]; 
    mapQuest = new OpenLayers.Layer.OSM("MapQuest", arrayOSM); 
    
    map = new OpenLayers.Map('map', {
        maxResolution: 156543.0339,
        units: 'm',
        projection: new OpenLayers.Projection('EPSG:900913'),
        displayProjection: new OpenLayers.Projection("EPSG:4326")
    });
                
    point_layer = new OpenLayers.Layer.Vector("Puntos",{
        style: {
            'fillColor': '#669933',
            'fillOpacity': .9,
            // 'strokeColor': '#aaee77',
            //'strokeWidth': 3,
            //'graphicHeight': 25,
            // 'graphicWidth': 20,
            'pointRadius': 10,
            'cursor':'pointer',
            //'externalGraphic': 'http://www.openlayers.org/dev/img/marker.png'
            'externalGraphic': '../img/marker.png'
        }
    });
    var google_streets = new OpenLayers.Layer.Google(
        "Google Streets",
        {
            numZoomLevels: 20
        }
        );
            
         
    pointLayer = new OpenLayers.Layer.Vector("Editar");
    osm = new OpenLayers.Layer.OSM();
    map.addLayers([google_streets,mapQuest,osm,point_layer,pointLayer]);
      
    
    map.zoomToExtent(new OpenLayers.Bounds(-103.48,20.83,-103.097,20.429).transform(map.displayProjection,map.projection));
 
}
var feature; 
 
function graFicarbuscarSitioMapa(){   
    feature = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(-103.31244,20.63932).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()), 
    {
        nombre:'MAYA INKA',
        dire:'Artesanias',
        telf:'Nombre',
        mail:'Nombre'
    }, {
        strokeWidth : 1,
        pointRadius : 15,
        'externalGraphic': 'web2/Master/OL/OpenLayers/img/hat.png',
        cursor:'Pointer'
    });
    

    point_layer= new OpenLayers.Layer.Vector("Points",{
        eventListeners:{
            'featureselected':function(evt){
                var feature = evt.feature;
                var popup = new OpenLayers.Popup.FramedCloud("popup",OpenLayers.LonLat.fromString(feature.geometry.toShortString()),
                    null,
                    "<div id='detalleBusqda'>Nombre: "+feature.attributes.nombre+"</div>",
                    null,
                    true
                    );
                feature.popup = popup;
                map.addPopup(popup);
            },
            'featureunselected':function(evt){
                var feature = evt.feature;
                map.removePopup(feature.popup);
                feature.popup.destroy();
                feature.popup = null;
            }
        }
    });
    
    point_layer.addFeatures(feature);
    
    var selector = new OpenLayers.Control.SelectFeature(point_layer,{
        click:true,
        autoActivate:true
    });
    map.addLayers([osm,point_layer]); 
    map.addControl(selector); 
}
/*
var feature2;  
function graFicarbuscarSitioMapa2(){
    feature2 = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(-103.31326,20.63936).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()), 
    {
        nombre:'MAYA INKA',
        dire:'Artesanias',
        telf:'Nombre',
        mail:'Nombre'
    }, {
        
        strokeWidth : 1,
        pointRadius : 15,
        'externalGraphic': 'web2/Master/OL/OpenLayers/img/blouse.png',
        cursor:'Pointer'
    });
    
    point_layer= new OpenLayers.Layer.Vector("Points",{
        eventListeners:{
            'featureselected':function(evt){
                var feature = evt.feature;
                var popup = new OpenLayers.Popup.FramedCloud("popup",OpenLayers.LonLat.fromString(feature.geometry.toShortString()),
                    null,
                    "<div id='detalleBusqda'>Nombre: "+feature.attributes.nombre+"</div>",
                    null,
                    true
                    );
                feature.popup = popup;
                map.addPopup(popup);
            },
            'featureunselected':function(evt){
                var feature = evt.feature;
                map.removePopup(feature.popup);
                feature.popup.destroy();
                feature.popup = null;
            }
        }
    });
    
    point_layer.addFeatures(feature2);
    
    var selector = new OpenLayers.Control.SelectFeature(point_layer,{
        click:true,
        autoActivate:true
    });
    map.addLayers([osm,point_layer]); 
    map.addControl(selector);
    graFicarbuscarSitioMapa3();
}
var feature3; 
 
function graFicarbuscarSitioMapa3(){
    feature3 = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(-103.31446,20.63947).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()), 
    {
        nombre:'MAYA INKA',
        dire:'Artesanias',
        telf:'Nombre',
        mail:'Nombre'
    }, {
        strokeWidth : 1,
        pointRadius : 15,
        'externalGraphic': 'web2/Master/OL/OpenLayers/img/shirt.png',
        cursor:'Pointer'
    });
    
    point_layer= new OpenLayers.Layer.Vector("Points",{
        eventListeners:{
            'featureselected':function(evt){
                var feature = evt.feature;
                var popup = new OpenLayers.Popup.FramedCloud("popup",OpenLayers.LonLat.fromString(feature.geometry.toShortString()),
                    null,
                    "<div id='detalleBusqda'>Nombre: "+feature.attributes.nombre+"</div>",
                    null,
                    true
                    );
                feature.popup = popup;
                map.addPopup(popup);
            },
            'featureunselected':function(evt){
                var feature = evt.feature;
                map.removePopup(feature.popup);
                feature.popup.destroy();
                feature.popup = null;
            }
        }
    });
    
    point_layer.addFeatures(feature3);    
    var selector = new OpenLayers.Control.SelectFeature(point_layer,{
        click:true,
        autoActivate:true
    });
    map.addLayers([osm,point_layer]); 
    map.addControl(selector);
}
*/
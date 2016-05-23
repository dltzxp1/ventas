     
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
 
    var google_streets = new OpenLayers.Layer.Google(
        "Google Streets",
        {
            numZoomLevels: 20
        }
        );
                
    point_layer = new OpenLayers.Layer.Vector("Puntos",{
        style: {
            'fillColor': '#669933',
            'fillOpacity': .9,
            'pointRadius': 10,
            'cursor':'pointer',
            'externalGraphic': '../img/marker.png'
        }
    });
    osm = new OpenLayers.Layer.OSM(); 
    editingControl = new OpenLayers.Control.EditingToolbar(point_layer);
    modifyControl = new OpenLayers.Control.ModifyFeature(point_layer, {
        toggle: true
    });
    editingControl.addControls([modifyControl]); 
    map.addLayers([google_streets,osm,point_layer,mapQuest]); 
    map.addControl(new OpenLayers.Control.LayerSwitcher());
    map.addControl(new OpenLayers.Control.MousePosition());  
    map.zoomToExtent(new OpenLayers.Bounds(-103.48,20.83,-103.097,20.429).transform(map.displayProjection,map.projection));
    
       
    
//   map.zoomToExtent(new OpenLayers.Bounds(-103.48,20.83,-103.097,20.429).transform(map.displayProjection,map.projection));
 
} 
function graFicarbuscarSitioMapa(){ 
    feature = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(-103.31244,20.63932).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()), 
    {
        nombre:'MAYA-INKA',
        dire:'Artesanias',
        telf:'Nombre',
        mail:'Nombre'
    }, {
        strokeWidth : 1,
        pointRadius : 15,
        'externalGraphic': 'img/hat.png',
        cursor:'Pointer'
    });

    point_layer= new OpenLayers.Layer.Vector("Points",{
        eventListeners:{
            'featureselected':function(evt){
                var feature = evt.feature;
                var popup = new OpenLayers.Popup.FramedCloud("popup",OpenLayers.LonLat.fromString(feature.geometry.toShortString()),
                    null,
                    "<div id='detalleBusqda'>Artesanias: "+feature.attributes.nombre+" </div>",
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

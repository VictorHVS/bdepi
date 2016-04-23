<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>Leaflet Draw</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
    <style>
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:100%; }
    </style>
</head>
<body>

<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-draw/v0.2.3/leaflet.draw.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-draw/v0.2.3/leaflet.draw.js'></script>
<script data-rocketsrc="//code.jquery.com/jquery-1.10.2.min.js" type="text/rocketscript"></script>

<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />

<div id='map'></div>

<style>
    .filter-ctrl {
        position: absolute;
        top: 12px;
        left: 50px;
        z-index: 1;
        width: 180px;
    }

    .menu-ui {
        background:#fff;
        position:absolute;
        top:10px;right:10px;
        z-index:1;
        border-radius:3px;
        width:170px;
        border:1px solid rgba(0,0,0,0.4);
    }
    .menu-ui a {
        font-size:13px;
        color:#404040;
        display:block;
        margin:0;padding:0;
        padding:10px;
        text-decoration:none;
        border-bottom:1px solid rgba(0,0,0,0.25);
        text-align:center;
    }
    .menu-ui a:first-child {
        border-radius:3px 3px 0 0;
    }
    .menu-ui a:last-child {
        border:none;
        border-radius:0 0 3px 3px;
    }
    .menu-ui a:hover {
        background:#f8f8f8;
        color:#404040;
    }
    .menu-ui a.active {
        background:#3887BE;
        color:#FFF;
    }
    .menu-ui a.active:hover {
        background:#3074a4;
    }
</style>

<div>
    <nav id='map-ui' class='menu-ui'>
        <a class='active' id='salvar'>Salvar</a>
    </nav>
</div>

<script>

    L.mapbox.accessToken = 'pk.eyJ1IjoidmljdG9yaHVnbyIsImEiOiJjaW15NWNvNXYwM3g0djdrazZjZjRqdmI4In0.A3O0p-zpU1Yn1AgmeKbnag';
    var map = L.mapbox.map('map', 'mapbox.streets')
        .setView([38.89399, -77.03659], 2);

    var geojson = {!! $dados !!}
    var geoJsonDeleted = [];

    var featureGroup = L.geoJson(geojson).addTo(map);

    var drawControl = new L.Control.Draw({
        edit: {
            featureGroup: featureGroup
        }
    }).addTo(map);

    map.on('draw:deleted', function (e) {
        var layers = e.layers;
        layers.eachLayer(function (layer) {
            //do whatever you want, most likely save back to db
            geoJsonDeleted.push(layer.feature);
        });
    });

    map.on('draw:created', function(e) {
        featureGroup.addLayer(e.layer);
    });

    var markers = L.markerClusterGroup();

    var geoJsonLayer = L.geoJson(geojson, {
        onEachFeature: function (feature, layer) {
        }
    });
    markers.addLayer(geoJsonLayer);
    map.addLayer(markers);
    map.fitBounds(markers.getBounds());

//    L.mapbox.accessToken = 'pk.eyJ1IjoidmljdG9yaHVnbyIsImEiOiJjaW15NWNvNXYwM3g0djdrazZjZjRqdmI4In0.A3O0p-zpU1Yn1AgmeKbnag';
//    var map = L.mapbox.map('map', 'mapbox.streets')
//        .setView([38.89399, -77.03659], 2);


//    var geoJsonDeleted = [];
//
//    var featureGroup = L.featureGroup().addTo(map);
//    var drawControl = new L.Control.Draw({
//        edit: {
//            featureGroup: featureGroup
//        }
//    }).addTo(map);
//
//    map.on('draw:created', function(e) {
//        featureGroup.addLayer(e.layer);
//    });
//    map.on('draw:deleted', function (e) {
//        var layers = e.layers;
//        layers.eachLayer(function (layer) {
//            //do whatever you want, most likely save back to db
//            geoJsonDeleted.push(layer.feature);
//        });
//    });
//    var markers = L.markerClusterGroup();
//
//    var geoJsonLayer = L.geoJson(geojson, {
//        onEachFeature: function (feature, layer) {
//            layer.bindPopup("AEHOOO!!!");
//        }
//    });
//
//    markers.addLayer(geoJsonLayer);
//    map.addLayer(markers);
//    map.fitBounds(markers.getBounds());



    jQuery(document).ready(function(){
        jQuery('#salvar').click(function(){

            var jsonDeleted = JSON.stringify(geoJsonDeleted);
            jQuery.ajax({
                type: "DELETE",
                url: "/delete",
                data: jsonDeleted,
                error: function(xhr, status, error) {
                    console.log(error + " status: " + status);
                },
                success: function (data, status) {
                    console.log("response: " + data + " status: " + status);
                }
            });

            var dados = JSON.stringify(featureGroup.toGeoJSON());
                jQuery.ajax({
                    type: "POST",
                    url: "/save",
                    data: dados,
                    error: function(xhr, status, error) {
                        console.log(error + " status: " + status);
                    },
                    success: function (data, status) {
                        console.log("response: " + data + " status: " + status);
                    }
                });

            return false;
        });
    });

</script>

</body>
</html>

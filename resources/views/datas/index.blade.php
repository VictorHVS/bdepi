<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8/>
    <title>BDEPI Index</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no'/>
    <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet'/>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<div id='map'></div>
<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoidmljdG9yaHVnbyIsImEiOiJjaW15NWNvNXYwM3g0djdrazZjZjRqdmI4In0.A3O0p-zpU1Yn1AgmeKbnag';

    var geojson = {!! $dados !!};

    L.mapbox.map('map', 'mapbox.streets')
        .setView([37.8, -96], 3)
        .featureLayer.setGeoJSON(geojson);
</script>
</body>
</html>


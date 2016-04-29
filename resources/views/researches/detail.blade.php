@extends('base')

@section('head')
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet'/>
@endsection

@section('content')

<div class="col-md-3 details">
    <div class="col-md-12 info">
        <p class="card-title">{{ $research->title }}</p>
        <br>
        <p class="card-label">Autores:
        <p class="card-autor">{{ $research->user->name }}</p>
        </p>
        <p class="card-label">Postado em:
        <p class="date">{{ $research->created_at }}</p>
        </p>
        <p class="card-description"></p>
        @foreach ($research->keyWords as $key)
        <span class="label label-default">{{ $key->name }}</span>
        @endforeach
        <p class="card-resume">{{ $research->abstract }}</p>
    </div>
</div>
<div class="col-md-9 mapa">
    <!--
    <div class='filter-ctrl'>
        <input id='filter-input' onkeyup="" type='text' name='filter' placeholder='Buscar por Campus' />
    </div>
-->
    <div id="points">
        <div class="info-title">Pontos Cadastrados</div>
    </div>
    <div id="map"></div>
</div>

<!--    </div>-->

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoidmljdG9yaHVnbyIsImEiOiJjaW15NWNvNXYwM3g0djdrazZjZjRqdmI4In0.A3O0p-zpU1Yn1AgmeKbnag';
    var map = L.mapbox.map('map', 'mapbox.streets')
        .setView([38.89399, -77.03659], 2);

    var geojson = {!! $data !!};

    var layer = L.mapbox.featureLayer(geojson).addTo(map);

    (function addPinInList() {
        var divPoints = document.getElementById('points');
        geojson.forEach(function (iten) {
            divPoints.innerHTML = divPoints.innerHTML + '<div onclick="setView(' + iten.geometry.coordinates + ')" class="point-card">' + iten.properties.title + '</div>';
        })
    })();

    function setView(a, b) {
        map.setView([b, a], 15);
    }

    function setEdit(layer) {
        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: layer
            }
        }).addTo(map);
    }

</script>

@endsection
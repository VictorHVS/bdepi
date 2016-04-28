@extends('base')

@section('head')
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
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
        <span class="label label-default">PALAVRA CHAVE</span>
        <span class="label label-default">key word</span>
        <span class="label label-default">tag</span>
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
    <div id="points"></div>
    <div id="map"></div>
</div>


<!--    </div>-->

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoidmljdG9yaHVnbyIsImEiOiJjaW15NWNvNXYwM3g0djdrazZjZjRqdmI4In0.A3O0p-zpU1Yn1AgmeKbnag';

    //atribui nessa variável geojson os dados espaciais
    var geojson = {!! $data !!};

    var map = L.mapbox.map('map', 'mapbox.streets').setView([-5.0884444, -42.8105416], 1);
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
</script>

@endsection
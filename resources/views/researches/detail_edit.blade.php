@extends('base')

@section('head')
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet'/>

<!--  leaflex  -->
<script src="/path/to/leaflet.js"></script>

<!--  bookmarks  -->
<script src="/path/to/Leaflet.Bookmarks.min.js"></script>
<link type="text/css" rel="stylesheet" href="{{asset('dist/leaflet.bookmarks.css')}}">

<!--  mapbox  -->
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />

<!--  menu de contexto  -->
<!--    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>-->
<script src="{{asset('dist/leaflet.contextmenu.js')}}"></script>
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
<link rel="stylesheet" href="{{asset('dist/leaflet.contextmenu.css')}}" />
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

<!-- Modal -->
<div class="modal fade" id="addDataModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <!-- Modal de cadastro de dados -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Adicionar novo dado <p id="latlng" class="card-label">asd</p></h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nome do dado</label>
                        <div class="col-sm-9">
                            <input id='data_title' type="text" class="form-control" placeholder="Ex.: Empresa X, Ponte Y, Lago Z">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Data da coleta</label>
                        <div class="col-sm-9">
                            <input id='data_date' type="text" class="form-control" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Descrição</label>
                        <div class="col-sm-9">
                            <textarea id='data_info' name="info" class="form-control" rows="4" placeholder="Ex.: Local de foco de mosquito"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Valor dado</label>
                        <div class="col-sm-9">
                            <input id='data_value' type="text" class="form-control" placeholder="Ex.: 12%, 4 eventos, 43 ml">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button onclick="saveData()" type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script>

    var geojson = {!! $data !!};
    var currentGeoJson = [];
    var pesquisa = {!! $research !!};

    var mark = {};
    ll = new L.LatLng(-5.0884444, -42.8105416);
    L.mapbox.accessToken = 'pk.eyJ1IjoidmljdG9yaHVnbyIsImEiOiJjaW15NWNvNXYwM3g0djdrazZjZjRqdmI4In0.A3O0p-zpU1Yn1AgmeKbnag';
    var map = L.mapbox.map('map', 'mapbox.streets', {
        center: ll,
        zoom: 10,
        contextmenu: true,
        contextmenuWidth: 140,
        contextmenuItems: [{
            text: 'Adiconar Dado',
            //                icon: 'images/zoom-in.png',
            callback: addData
        }]
    }).setView([-5.0884444, -42.8105416], 13);
    var layer = L.mapbox.featureLayer(geojson).addTo(map);

    function addData(e) {
        $('#latlng').text(e.latlng);
        mark.geometry = {};
        mark.geometry.coordinates = [e.latlng.lat, e.latlng.lng];
        $('#addDataModal').modal('show');

    }

    function saveData() {

        mark.type = "Feature";
        mark.geometry.type = "Point";
        mark.properties = {
            "title": $('#data_title').val(),
            "description": $('#data_info').val(),
            "research_id": pesquisa.id,
            "value": $('#data_value').val()
        }
        currentGeoJson.push(mark);
        L.marker(mark.geometry.coordinates, {
                title: mark.properties.title,
                description: mark.properties.description
            })
            .bindPopup('<strong>' + mark.properties.title + '</strong><br/>' + mark.properties.description)
            .addTo(map);
        //            map.removeLayer(layer);
        //            layer = L.mapbox.featureLayer(geojson).addTo(map);

        //            console.log(currentGeoJson);
        //            console.log(layer.getGeoJSON());

        mark = {};
        $.ajax({
            type: "POST",
            url: "/data/save",
            data: JSON.stringify(currentGeoJson),
            error: function (xhr, status, error) {
                console.log(error + " status: " + status);
            },
            success: function (data, status) {
                console.log("response: " + data + " status: " + status);
            }
        });
        pointInfo();
        $('#addDataModal').modal('hide');
    }

    function pointInfo() {
        var divPoints = document.getElementById('points');
        var iten = currentGeoJson[currentGeoJson.length-1];
        divPoints.innerHTML = divPoints.innerHTML + '<div onclick="setView(' + iten.geometry.coordinates + ')" class="point-card">' + iten.properties.title + '</div>';
    }

    function setView(a, b) {
        map.setView([a, b], 15);
    }

</script>

@endsection
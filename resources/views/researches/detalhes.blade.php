@extends('base')

@section('head')
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
@endsection

@section('content')

<div class="col-md-3 details">

    <div class="col-md-12 info">
        <a href="#" class="card-title">Relato de Desenvolvimento de Plataforma de Gerência de Dados Espaciais</a>
        <br>
        <p class="card-label">Autores:
        <p class="card-autor">Lucas Nogueira e Victor Hugo</p>
        </p>
        <p class="card-label">Postado em:
        <p class="date">10/09/2015</p>
        </p>
        <p class="card-description"></p>

        <span class="label label-default">Default</span>
        <span class="label label-default">Default1</span>
        <span class="label label-default">Default2</span>

        <p class="card-resume">Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis. Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus sceleris</p>
    </div>


</div>
<div class="col-md-9 mapa">
    <div id="map"></div>
</div>
<div class="points"></div>

<!--    </div>-->

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoidmljdG9yaHVnbyIsImEiOiJjaW15NWNvNXYwM3g0djdrazZjZjRqdmI4In0.A3O0p-zpU1Yn1AgmeKbnag';

    //atribui nessa variável geojson os dados espaciais
    var geojson = [
        {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [
                    -42.8105416,  -5.0874444
                ]
            },
            "properties": {
                "title": "Maiores.",
                "description": "King said gravely, 'and go on till you come and.",
                "id": 1,
                "marker-color": "#fc9855",
                "marker-size": "large"
            }
        },
        {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [
                    -42.8115416, -5.0784444
                ]
            },
            "properties": {
                "title": "Enim.",
                "description": "Dormouse, not choosing to notice this last.",
                "id": 2,
                "marker-color": "#fc3436",
                "marker-size": "large"
            }
        },
        {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [
                    -42.8205416, -5.0884444
                ]
            },
            "properties": {
                "title": "Sint ut.",
                "description": "I shall be a great hurry. 'You did!' said the.",
                "id": 3,
                "marker-color": "#fc1693",
                "marker-size": "large"
            }
        }
    ];


    var map = L.mapbox.map('map', 'mapbox.streets').setView([-5.0884444, -42.8105416], 13);
    var layer = L.mapbox.featureLayer(geojson).addTo(map);

    //        addPopup(){
    //
    //        }
</script>

@endsection
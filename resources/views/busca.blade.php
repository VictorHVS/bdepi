@extends('base')
@section('content')

<div class="center-top">
    <!--        <h3 class="text-center title">Banco de Dados Geográficos</h3>-->
    <div class="col-md-offset-1 col-md-6">
        <div class="search padding-zero">
            <div class="col-sm-10 padding-zero">
                <input id="search" onkeyup="load()" type="search" class="search-input">
            </div>
            <div class="col-sm-2 padding-zero">
                <input type="submit" value="Buscar" onclick="search()" class="btn btn-search">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12 navbar-right">
            <button onclick="callNovo()" class="btn btn-card navbar-right">Novo</button>
        </div>
    </div>
</div>

<div class="col-md-10 col-md-offset-1">
    <div class="col-md-12">

        @foreach ($pesquisas as $pesquisa)
        <!-- modelo card-->
        <div class="col-md-12  card">
            <a href="#" class="card-title">[{{ $pesquisa->id }}] - {{ $pesquisa->nome }}</a><br>
            <p class="card-label">Autor:
            <p class="card-autor"> {{ $pesquisa->usuario->nome }}</p>
            </p>
            <p class="card-label">Postado em:
            <p class="date">{{ $pesquisa->data_publicacao }}</p>
            </p>

            <p class="card-description"></p>

            @foreach ($pesquisa->palavrasChave as $chave)
            <span class="label label-default">{{ $chave->nome }}</span>
            @endforeach
        </div>
        @endforeach
    </div>
</div>

<script>
    $(document).ready(function () {

        var key = $_GET('q');
       // key = key.replace("+", " ");
        $("#search").val(key);
        //            $("#search").focus();
        search(key);

    })

    function $_GET(param) {
        var vars = {};
        window.location.href.replace(location.hash, '').replace(
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function (m, key, value) { // callback
                vars[key] = value !== undefined ? value : '';
            }
        );

        if (param) {
            return vars[param] ? vars[param] : null;
        }
        return vars;
    }

    var a;

    function load() {
        clearTimeout(a);
        a = setTimeout(function () {
            search($("#search").val());
        }, 1000);
    }

    $("#search").keypress(function (event) {
        if (event.which == 13) {
            search($("#search").val());
        }
    });

    function search(key) {
        clearTimeout(a);
        var key = key || $("#search").val();
        if (key) {
            console.log("buscar por " + key);
        }
    }
</script>

@endsection
@extends('base')

@section('content')

<div class="topbar col-md-12">
    <div class="col-md-10 col-md-offset-1">

        <button onclick="callNovo()" class="btn btn-card1 navbar-right">Novo</button>
    </div>
</div>

<section class="">

    <div class="col-md-offset-3 col-md-6 center-top1">

        <h3 class="text-center title">Banco de Dados Geográficos</h3>

        <div class="search padding-zero">
            <div class="col-sm-10 padding-zero">
                <input id="search" type="search" class="search-input">
            </div>
            <div class="col-sm-2 padding-zero">
                <input type="submit" value="Buscar" onclick="search()" class="btn btn-search">
            </div>
        </div>
    </div>

</section>

@endsection
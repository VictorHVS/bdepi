@extends('base')

@section('head')
<link rel="stylesheet" href="{{asset('frontend/css/index.css')}}">
@endsection

@section('content')

<section class="section-search">
    <div class="col-md-offset-3 col-md-6 center-top">
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
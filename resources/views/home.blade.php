@extends('base')

@section('content')
<div class="topbar col-md-12">
    <div class="col-md-10 col-md-offset-1">
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
            @else
            <button onclick="callNovo()" class="btn btn-card1 navbar-right">Nova Pesquisa</button>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>
            @endif
        </ul>
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

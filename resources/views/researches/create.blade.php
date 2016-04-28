@extends('base')

@section('content')

<div class="center-top">

</div>

<div class="col-md-6 col-md-offset-3">
    <div class="form">
        <h3>Cadastrar Nova Pesquisa</h3>
        <form method="post" action="/pesquisa/create">
            <div class="form-group">
                <label for="exampleInputEmail1">Título do Trabalho</label>
                <input type="text" name="titulo" class="form-control" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Palavras Chave</label>
                <input type="text" name="palavras_chave" class="form-control" placeholder="local; rua; casa;">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Resumo</label>
                <textarea class="form-control" name="resumo" rows="10"></textarea>
            </div>


            <button type="submit" class="btn btn-card center btn-block">Cadastrar</button>
        </form>
    </div>
</div>

@endsection
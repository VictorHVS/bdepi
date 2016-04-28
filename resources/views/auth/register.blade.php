@extends('base')
@section('content')

<div class="center-top"></div>
<div class="col-md-6 col-md-offset-3">
    <div class="form">
        <form role="form" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}
            <h3>Cadastrar Novo Usuário</h3>
            <div class="form-group">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Maria Gorete da Costa" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="seu@email.com">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Senha</label>
                    <input type="password" class="form-control" name="password" placeholder="123456">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label>Confirmar Senha</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="123456">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-card center btn-block">Cadastrar</button>
        </form>
    </div>
</div>

@endsection

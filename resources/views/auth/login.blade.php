@extends('base')
@section('content')

<div class="center-top">

</div>

<div class="col-md-6 col-md-offset-3">
    <div class="form">
        <h3>Login</h3>
        <form method="post" action="/auth/login">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control">
            </div>
            <div>
                <input type="checkbox" name="remember"> Remember me
            </div>

            <button type="submit" class="btn btn-card center btn-block">Login</button>
        </form>
    </div>
</div>

@endsection
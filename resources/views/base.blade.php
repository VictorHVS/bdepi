<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>BDEPI - Banco de Dados Espaciais do Piuaí</title>
    <link rel="stylesheet" href="{{asset('css/search.css')}}">

    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    @yield('head')

</head>

<body>

@yield('content')

<script>
    function search() {
        var key = $('#search').val();
        console.log('call' + key);
        if (key) {
            //key = key.replace(" ", "+");
            //var url = window.location.href.replace('index.html','/busca/?q=')
            window.location.replace("/busca/" + key + '');
        }
    }

    $("#search").keypress(function (event) {
        if (event.which == 13) {
            search();
        }
    });

    function callNovo() {
        var url = window.location.href.replace('index.html', 'create.html')
        window.location.replace(url);
    }
</script>

</body>

</html>
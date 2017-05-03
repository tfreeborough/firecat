<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Firecat</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="flex-center position-ref full-height">
    @section('menu')
    @show

    @if(Auth::user())
        <div id="app" class="authenticated">
            @yield('content')
        </div>
    @else
        <div id="app">
            @yield('content')
        </div>
    @endif

</div>
</body>
</html>

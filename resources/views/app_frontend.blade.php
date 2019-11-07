<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ url('images/favicon.png') }}">
    <meta name="theme-color" content="#218884" />
    <meta name="google-site-verification" content="-E-jpLrJREqmmHGrduAgO7snsqyIaVzg9l9q4Ibf7bE" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Firecat</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <!-- Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet" type="text/css">
</head>
    <body class="guest" style="background-color:#5DBBB7;">
        <div class="flex-center position-ref full-height">
            @include('_partials.menu')

            <div id="app">
                @yield('content')
            </div>

            @include('scripts.frontend')
            @include('scripts.main')
        </div>
        <div id="particles-js"></div>
    </body>
</html>

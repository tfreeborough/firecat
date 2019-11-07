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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="flex-center position-ref full-height">

    @include('_partials.authenticated.account_bar')

    @if(Auth::user())
        @if(Auth::user()->isPartner())
            @include('_partials.partner_menu')
        @elseif(Auth::user()->isVendor())
            @include('_partials.vendor_menu')
        @elseif(Auth::user()->isAdmin())
            @include('_partials.admin_menu')
        @endif
    @endif

    @if(Auth::user())
        <div id="app" class="authenticated">
            @yield('content')
        </div>
    @else
        <div id="app">
            @yield('content')
        </div>
    @endif


    @include('scripts.main')
</div>
</body>
</html>

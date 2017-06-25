@extends('app_frontend')

@section('title', 'Welcome')

@extends('_partials.menu')

@section('content')
    <div id="welcome">
        <div id="banner">
            <div id="banner-image"></div>
            <div id="banner-text">
                <h2>Your partners only settle for the best tech.<br/>so why won't you?</h2>
                <a href="{{route('register')}}">
                    <button id="banner-button" class="button large action">Create a <strong>Free</strong> account</button>
                </a>
            </div>
        </div>
        <div class="container">
            <div id="soon">
                <h1>Coming Soon.</h1>
                <p>
                    We're currently building firecat.io and when we're done, we'll be opening it up for beta testing to a small number of vendors. If you would
                    like to learn more about getting onto the beta program then please email.

                    <strong>tfreeborough@gmail.com</strong>
                </p>
            </div>
        </div>
    </div>
@endsection
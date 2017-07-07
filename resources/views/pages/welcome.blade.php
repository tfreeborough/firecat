@extends('app_frontend')

@section('title', 'Welcome')

@extends('_partials.menu')

@section('content')
    <div id="welcome">
        <div id="welcome-wrapper">
            <div id="logo-wrapper">
                <div id="menu-logo">
                    <span class="fire">FIRE</span><span class="cat">CAT</span>
                </div>
            </div>
            <div id="menu-links">
                <ul>
                    @if(Auth::user())
                        <a href="{{route('dashboard')}}"><li>Dashboard</li></a>
                        <a href="{{route('logout')}}"><li>Logout</li></a>
                    @else
                        <a href="{{route('register')}}"><li>Sign Up As A Partner</li></a>
                        <a href="{{route('login')}}"><li>Login</li></a>
                        <a href="{{route('docs')}}"><li>Documentation</li></a>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
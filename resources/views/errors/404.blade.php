@extends('app')

@section('title', 'End Users')

@if(Auth::user())
    @extends('_partials.menu')
@endif

@section('content')
    <div id="dashboard">
        <div id="not-found">
            <div id="not-found-content">
                <div id="menu-logo">
                    <a href="{{route('dashboard')}}">
                        <span class="fire">Page not found</span>
                    </a>
                </div>
                <p>Oops, looks like that page doesn't exist. Here's what you can do now.</p>
                <ul id="not-found-links">
                    <a href="{{route('dashboard')}}">
                        <li>
                            Go to my dashboard
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
@endsection
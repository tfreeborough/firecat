@extends('app_frontend')

@section('title', 'Finish Creating your account')

@section('content')
    <div id="invite">
        <div id="invite-wrapper">
            <div id="logo-banner" class="row">
                <div id="menu-logo" class="text-center">
                    <a href="{{route('home')}}">
                        <span class="fire">FIRE</span><span class="cat">CAT</span>
                    </a>
                </div>
                <h5 class="text-center">Deal Registration Portal</h5>
            </div>
            <div class="row">
                @include('_partials.flash_message')
            </div>
        </div>
    </div>
@endsection
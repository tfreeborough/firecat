@extends('app_frontend')

@section('title', 'Welcome')

@section('content')
    <div id="welcome">
        <div id="welcome-wrapper">
            <div id="welcome-wrapper-grid">
                <div id="welcome-wrapper-introduction">
                    <div>
                        <div id="logo-wrapper">
                            <div id="menu-logo">
                                <span class="fire">FIRE</span><span class="cat">CAT</span>
                                <h5 class="text-center">Deal Registration Portal</h5>
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
                <div id="welcome-wrapper-sign-up">
                    @if(Auth::user())
                        @include('_partials/landing/user_welcome')
                    @else
                        @include('_partials/landing/sign_up_form')
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function activateTab(event, t){
            var tab = $(event.target);
            $('#welcome-wrapper-tabulator li').removeClass('active');
            $(tab).addClass('active');
            $('#partner').removeClass('active');
            $('#vendor').removeClass('active');
            $('#'+t).addClass('active');
        }
    </script>

    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'signup'}).then(function(token) {
                $('#vendor .recaptcha').val(token);
                $('#partner .recaptcha').val(token);
            });
        });
    </script>
@endsection
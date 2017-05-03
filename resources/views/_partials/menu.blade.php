<div id="menu">
    <div id="menu-logo" class="pull-left">
        <a href="{{route('home')}}">
            <span class="fire">FIRE</span><span class="cat">CAT</span>
        </a>
    </div>
    <div id="menu-links" class="pull-right">
        <ul>
            <a href="{{route('home')}}"><li>Features</li></a>
            <a href="{{route('home')}}"><li>Pricing</li></a>
            <a href="{{route('register')}}"><li>Create Account</li></a>
            @if(Auth::user())
                <a href="{{route('logout')}}"><li>Logout</li></a>
            @else
                <a href="{{route('login')}}"><li>Login</li></a>
            @endif

        </ul>
    </div>
</div>
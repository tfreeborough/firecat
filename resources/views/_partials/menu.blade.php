<div id="menu">
    <div id="menu-logo" class="pull-left">
        <a href="{{route('dashboard')}}">
            <span class="fire">FIRE</span><span class="cat">CAT</span>
        </a>
    </div>
    <div id="menu-links" class="pull-right">
        <ul>
            @if(Auth::user())
                <a href="{{route('dashboard')}}"><li>Dashboard</li></a>
                <a href="{{route('logout')}}"><li>Logout</li></a>
            @else
                <a href="{{route('register')}}"><li>Sign Up As A Partner</li></a>
                <a href="{{route('login')}}"><li>Login</li></a>
            @endif
        </ul>
    </div>
</div>
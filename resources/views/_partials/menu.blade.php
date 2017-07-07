<div id="menu">
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
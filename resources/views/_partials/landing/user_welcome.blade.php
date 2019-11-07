<div id="user_welcome">
    <div id="welcome_avatar">
        <img src="{{Auth::user()->getAvatar()}}" />
    </div>
    <h1>Welcome back, {{ Auth::user()->name() }}</h1>
    <a href="{{ route('dashboard') }}">
        <button class="button action">View my Dashboard</button>
    </a>
</div>

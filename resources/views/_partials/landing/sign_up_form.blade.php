<div id="welcome-wrapper-sign-up-form-wrapper">
    <h2 class="title text-left">Get started today</h2>
    <div id="welcome-wrapper-tabulator">
        <ul>
            <li class="active" onclick="activateTab(event, 'partner')">Partners</li>
            <li onclick="activateTab(event, 'vendor')">Vendors</li>
        </ul>
    </div>
    <div id="welcome-wrapper-tabbed-content" class="text-left">
        @include('_partials.flash_message')
        @include('_partials.landing.form.partner')
        @include('_partials.landing.form.vendor')
    </div>
    <div id="extra-links" class="row">
        <div class="col-xs-12">
            <a href="{{ route('login') }}">Login</a> | <a href="{{ route('password.reset.view') }}">Forgotten your password?</a>
        </div>
    </div>
</div>

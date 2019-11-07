@auth
    @if(!Auth::user()->isVerified())
        <div class="flash-message">
            <div class="alert alert-danger">
                <p class="m-0">
                    Your email is not verified, this means that you won't be able to perform certain actions until it
                    has been confirmed.
                </p>
                <p class="m-0">
                    If you need to resend your code you can do so <a href="{{ route('resend-verification') }}">here.</a>
                </p>
            </div>
        </div>
    @endif
@endauth

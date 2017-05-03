@extends('app')

@section('title', 'Thanks!')

@extends('_partials.menu')

@section('content')
    <div id="verify">
        <div class="container">
            <div class="row">
                <div id="verify-wrapper" class="col-xs-12 col-sm-8 col-sm-offset-2 text-center">
                    <div class="col-xs-6">
                        <img class="content" src="/images/verify.png" />
                    </div>
                    <div class="col-xs-6">
                        <div class="content">
                            <h1>Thanks for that!</h1>
                            <p>
                                Thanks for registering as a partner with Firecat. We've sent you an email to verify your account belongs to you, could you go
                                ahead and check your email and click the link inside.
                            </p>
                            <p>
                                <strong>Welcome to the Firecat family.</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
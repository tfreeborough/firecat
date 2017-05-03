@extends('app')

@section('title', 'Thanks!')

@extends('_partials.menu')

@section('content')
    <div id="verify">
        <div class="container">
            <div class="row">
                <div id="verify-wrapper" class="col-xs-12 col-sm-8 col-sm-offset-2 text-center">
                    @if(Session::has('status'))
                        <div class="col-xs-12">
                            <div class="alert alert-info">
                                <ul>
                                    <li>{{Session::get('status')}}</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="col-xs-12 col-sm-6 text-left">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 text-left">
                            {!! Form::open(['url' => '/verify/resend']) !!}
                            <div class="form-group">
                                {{ Form::label('email', null, ['class' => 'control-label']) }}
                                {{ Form::text('email', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Re-send activation code', array_merge(['class' => 'form-control button action'])) }}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    @else
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('app_frontend')

@section('title', 'Thanks!')

@extends('_partials.menu')

@section('content')
    <div id="verify">
        <div id="verify-wrapper">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="title">
                        Resend my activation code
                    </h2>
                    <p>If you're activation code has expired then you can request another one to be sent out here.</p>
                    @include('_partials.flash_message')
                    {!! Form::open(['url' => '/verify/resend']) !!}
                    <div class="form-group">
                        {{ Form::label('email', null, ['class' => 'control-label']) }}
                        {{ Form::text('email', null, array_merge(['class' => 'form-control', 'placeholder' => 'Email'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Re-send activation code', array_merge(['class' => 'form-control button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
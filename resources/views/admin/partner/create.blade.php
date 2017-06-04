@extends('app')

@section('title', 'Partner Management')

@extends('_partials.authenticated.account_bar')
@extends('_partials.admin_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Create a new Partner</h1>
            <h5 id="page-subtitle">Create a new partner account for Firecat.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.partners')}}">
                            Partner Management
                        </a>
                    </li>
                    <li>
                        Create a new Partner
                    </li>
                </ul>
            </div>
        </div>
        <div id="create_partner">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-xs-12">
                        <div id="login-errors" class="text-left">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    {!! Form::open(['url' => '/admin/partners/create']) !!}
                    <div class="form-group">
                        {{ Form::label('first_name', null, ['class' => 'control-label']) }}
                        {{ Form::text('first_name', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('last_name', null, ['class' => 'control-label']) }}
                        {{ Form::text('last_name', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', null, ['class' => 'control-label']) }}
                        {{ Form::text('email', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', null, ['class' => 'control-label']) }}
                        {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_confirmation', null, ['class' => 'control-label']) }}
                        {{ Form::password('password_confirmation', array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Create User and Link', array_merge(['class' => 'form-control button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
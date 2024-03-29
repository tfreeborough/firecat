@extends('app')

@section('title', 'Create an Organisation')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Create an Organisation</h1>
            <h5 id="page-subtitle">Set up a new Organisation for Firecat.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.onboarding')}}">
                            Onboarding
                        </a>
                    </li>
                    <li>
                        Create Organisation
                    </li>
                </ul>
            </div>
        </div>
        <div id="create_organisation">
            @include('_partials.flash_message')
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    {!! Form::open(['url' => '/admin/onboarding/create']) !!}
                    <div class="form-group">
                        {{ Form::label('name', null, ['class' => 'control-label']) }}
                        {{ Form::text('name', null, array_merge(['class' => 'form-control', 'autofocus' => true,'autocomplete' => 'off'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Create', array_merge(['class' => 'form-control button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
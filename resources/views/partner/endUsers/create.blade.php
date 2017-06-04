@extends('app')

@section('title', 'Create a new end user')

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Create a new end user</h1>
            <h5 id="page-subtitle">Create a new end user for opportunities.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('partner.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('partner.endUsers')}}">
                            End Users
                        </a>
                    </li>
                    <li>
                        Create a new end user
                    </li>
                </ul>
            </div>
        </div>
        <div id="create-end-user">
            {!! Form::open(['url' => '/partner/end-users/create']) !!}
            <div id="create-end-user-form" class="row">
                <div class="col-xs-12">
                    <h3 class="title">End User</h3>
                </div>
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="col-xs-12">
                            <div id="create-end-user-errors" class="text-left">
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
                <div class="col-xs-12 col-sm-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="subtitle">Basic</h3>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                {{ Form::label('name', 'Name', ['class' => 'control-label required']) }}
                                {{ Form::text('name', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                {{ Form::label('organisation_type', 'Organisation Type', ['class' => 'control-label required']) }}
                                {{ Form::select('organisation_type', \App\Helpers\Helper::getSectorList(), 0, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="subtitle">Address</h3>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                {{ Form::label('address_line_1', 'Address Line 1', ['class' => 'control-label required']) }}
                                {{ Form::text('address_line_1', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                {{ Form::label('address_line_2', 'Address Line 2', ['class' => 'control-label']) }}
                                {{ Form::text('address_line_2', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                {{ Form::label('city', 'City', ['class' => 'control-label required']) }}
                                {{ Form::text('city', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                {{ Form::label('county', 'County', ['class' => 'control-label required']) }}
                                {{ Form::text('county', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                {{ Form::label('country', 'Country', ['class' => 'control-label required']) }}
                                {{ Form::select('country', \App\Helpers\Helper::getCountryList(), 243, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                {{ Form::label('postcode', 'Postcode', ['class' => 'control-label required']) }}
                                {{ Form::text('postcode', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="subtitle">Organisational Contact</h3>
                        </div>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('contact_name', 'Contact Name', ['class' => 'control-label required']) }}
                                        {{ Form::text('contact_name', null, array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('contact_number', 'Contact Number', ['class' => 'control-label required']) }}
                                        {{ Form::text('contact_number', null, array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('contact_email', 'Contact Email', ['class' => 'control-label required']) }}
                                        {{ Form::text('contact_email', null, array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('contact_job_title', 'Contact\'s Job Title', ['class' => 'control-label']) }}
                                        {{ Form::text('contact_job_title', null, array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="subtitle">Organisation Miscellaneous</h3>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                {{ Form::label('parent_organisation', 'Parent Organisation', ['class' => 'control-label']) }}
                                {{ Form::text('parent_organisation', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::submit('Create end user', array_merge(['class' => 'button action large'])) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
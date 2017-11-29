@extends('app')

@section('title', 'My Account')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')


@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Account</h1>
            <h5 id="page-subtitle">Edit your personal account settings.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        Account
                    </li>
                </ul>
            </div>
        </div>
        <div id="account-settings">
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
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h3 class="title">Additional Information</h3>
                    {!! Form::open(['url' => '/vendor/account/additional']) !!}
                    <div class="form-group">
                        {{ Form::label('secondary_email', null, ['class' => 'control-label']) }}
                        {{ Form::text('secondary_email', $user->extra->second_email, array_merge(['class' => 'form-control', 'placeholder' => 'This can be a personal email if you wish'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('work_phone', null, ['class' => 'control-label']) }}
                        {{ Form::text('work_phone', $user->extra->work_number, array_merge(['class' => 'form-control', 'placeholder' => 'Enter your most used work telephone number'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('mobile_phone', null, ['class' => 'control-label']) }}
                        {{ Form::text('mobile_phone', $user->extra->mobile_number, array_merge(['class' => 'form-control', 'placeholder' => 'This can be a personal mobile if you wish'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Update account', array_merge(['class' => 'button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-xs-12 col-sm-6">
                    <h3 class="title">Update my avatar</h3>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            {!! Form::open(['url' => '/vendor/account/avatar', 'files' => true]) !!}
                            <div class="form-group">
                                {{ Form::label('avatar', null, ['class' => 'control-label']) }}
                                {{ Form::file('avatar', null, array_merge(['class' => 'form-control'])) }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Upload Avatar', array_merge(['class' => 'button action'])) }}
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @if($user->extra->avatar_id)
                                <div class="avatar">
                                </div>
                            @else
                                <div class="avatar">
                                    <img class="default-avatar" src="/images/avatar.png" />
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        @if($user->extra->avatar_id)
        $('#account-settings .avatar').html($.cloudinary.image('{{ $user->extra->avatar_id }}', { width: 128, height: 128, crop: 'fill', gravity: 'face' }));
        @endif
    </script>
@endsection
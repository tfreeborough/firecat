@extends('app')

@section('title', 'My Account')

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
        @include('_partials.flash_message')
        <div id="account-settings">
            <div id="additional_information" class="block">
                <h3 class="title">Additional Information</h3>
                {!! Form::open(['url' => '/partner/account/additional']) !!}
                <div class="form-group">
                    {{ Form::label('secondary_email', null, ['class' => 'control-label']) }}
                    {{ Form::text('secondary_email', $user->extra->second_email, array_merge(['class' => 'form-control', 'placeholder' => 'This can be a personal email if you wish','autocomplete' => 'off'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label('work_phone', null, ['class' => 'control-label']) }}
                    {{ Form::text('work_phone', $user->extra->work_number, array_merge(['class' => 'form-control', 'placeholder' => 'Enter your most used work telephone number','autocomplete' => 'off'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label('mobile_phone', null, ['class' => 'control-label']) }}
                    {{ Form::text('mobile_phone', $user->extra->mobile_number, array_merge(['class' => 'form-control', 'placeholder' => 'This can be a personal mobile if you wish','autocomplete' => 'off'])) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Update account', array_merge(['class' => 'button action'])) }}
                </div>
                {!! Form::close() !!}
            </div>
            <div id="avatar_update" class="block">
                <h3 class="title">Update my avatar</h3>
                <div>
                    @if($user->extra->avatar_id)
                        <div class="avatar">
                        </div>
                    @else
                        <div class="avatar">
                            <img class="default-avatar" src="/images/avatar.png" />
                        </div>
                    @endif
                </div>
                <div id="avatar_update_form">
                    {!! Form::open(['url' => '/partner/account/avatar', 'files' => true]) !!}
                    <div class="form-group file_upload">
                        {{ Form::label('avatar', 'Click to select a file', ['class' => 'control-label']) }}
                        {{ Form::file('avatar', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Update Avatar', array_merge(['class' => 'button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div id="account_settings" class="block">
                <h3 class="title">Account Settings</h3>
                <div id="account_settings_email" class="block">
                    <h4 class="title">Change your email</h4>
                    {!! Form::open(['url' => route('partner.account.email')]) !!}
                    {{ csrf_field() }}
                    <div class="form-group">
                        {{ Form::text('email', null, array_merge(['class' => 'form-control', 'placeholder' => 'Enter a new email','autocomplete' => 'off'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Update email', array_merge(['class' => 'button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div id="account_settings_password" class="block">
                    <h4 class="title">Change your password</h4>
                    {!! Form::open(['url' => route('partner.account.password')]) !!}
                    {{ csrf_field() }}
                    <div class="form-group">
                        {{ Form::password('current_password' , array_merge(['class' => 'form-control', 'placeholder' => 'Enter your current password','autocomplete' => 'off'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::password('new_password' , array_merge(['class' => 'form-control', 'placeholder' => 'Enter your new password','autocomplete' => 'off'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::password('new_password_confirmation' , array_merge(['class' => 'form-control', 'placeholder' => 'Re-enter your new password','autocomplete' => 'off'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Update password', array_merge(['class' => 'button action'])) }}
                    </div>
                    {!! Form::close() !!}
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
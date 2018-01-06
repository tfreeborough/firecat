<div id="partner" class="active">
    <p>
        Sign up for <span class="highlight"><strong>free</strong></span> and create deal registrations
        with a wide range of Vendors across the UK within seconds.
    </p>
    {!! Form::open(['url' => '/register']) !!}
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                {{ Form::label('first_name', null, ['class' => 'control-label']) }}
                {{ Form::text('first_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'First Name', 'autocomplete' => 'off'])) }}
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                {{ Form::label('last_name', null, ['class' => 'control-label']) }}
                {{ Form::text('last_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'Last Name', 'autocomplete' => 'off'])) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                {{ Form::label('email', null, ['class' => 'control-label']) }}
                {{ Form::text('email', null, array_merge(['class' => 'form-control', 'placeholder' => 'Your Email', 'autocomplete' => 'off'])) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                {{ Form::label('password', null, ['class' => 'control-label']) }}
                {{ Form::password('password', array_merge(['class' => 'form-control', 'placeholder' => 'Password', 'autocomplete' => 'off'])) }}
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                {{ Form::label('password_confirmation', null, ['class' => 'control-label']) }}
                {{ Form::password('password_confirmation', array_merge(['class' => 'form-control', 'placeholder' => 'Password Confirmation', 'autocomplete' => 'off'])) }}
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6Le_sjgUAAAAACTbuusWiVJooy5L_TPKC210wGZF"></div>
    </div>
    <div class="form-group">
        {{ Form::submit('Create an account', array_merge(['class' => 'button action'])) }}
    </div>
    {!! Form::close() !!}
</div>
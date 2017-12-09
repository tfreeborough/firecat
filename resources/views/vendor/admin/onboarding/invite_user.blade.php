{!! Form::open(['url' => route('vendor.admin.onboarding.invite',$vendor->id)]) !!}
<div class="form-group">
    {{ Form::label('first_name', null, ['class' => 'control-label']) }}
    {{ Form::text('first_name', null, array_merge(['class' => 'form-control','autocomplete' => 'off', 'placeholder' => 'First Name'])) }}
</div>
<div class="form-group">
    {{ Form::label('last_name', null, ['class' => 'control-label']) }}
    {{ Form::text('last_name', null, array_merge(['class' => 'form-control','autocomplete' => 'off', 'placeholder' => 'Last Name'])) }}
</div>
<div class="form-group">
    {{ Form::label('email', null, ['class' => 'control-label']) }}
    {{ Form::text('email', null, array_merge(['class' => 'form-control','autocomplete' => 'off', 'placeholder' => 'Email'])) }}
</div>
<div class="form-group">
    {{ Form::label('admin', null, ['class' => 'control-label']) }}
    {{ Form::checkbox('admin', null, false, null) }}
</div>
<div class="form-group">
    {{ Form::submit('Invite user to '.$vendor->name, array_merge(['class' => 'button action'])) }}
</div>
{!! Form::close() !!}
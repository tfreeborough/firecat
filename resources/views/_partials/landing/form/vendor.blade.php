<div id="vendor">
    <div id="vendor-promo-wrapper">
        <p>
            Only members of our <span class="highlight"><strong>Beta Program</strong></span> may currently use Firecat. If you would like to see what
            Firecat can do for your business, <span class="highlight"><strong>register your interest below.</strong></span>
        </p>
        {!! Form::open(['url' => route('beta.interest')]) !!}
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('company_name', null, ['class' => 'control-label']) }}
                    {{ Form::text('company_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'Company Name', 'autocomplete' => 'off'])) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('contact_name', null, ['class' => 'control-label']) }}
                    {{ Form::text('contact_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'Contact Name', 'autocomplete' => 'off'])) }}
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('contact_email', null, ['class' => 'control-label']) }}
                    {{ Form::text('contact_email', null, array_merge(['class' => 'form-control', 'placeholder' => 'Contact Email', 'autocomplete' => 'off'])) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    {{ Form::label('account_managers', 'Number of Account Managers (Approx.)', ['class' => 'control-label', 'autocomplete' => 'off']) }}
                    {{ Form::number('account_managers', 10, array_merge(['class' => 'form-control'])) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            @include('_partials.recaptcha')
        </div>
        <div class="form-group">
            {{ Form::submit('Register your interest', array_merge(['class' => 'button action'])) }}
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div id="end_user">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="title">End User</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <p><strong>Name:</strong> {{ $opportunity->endUser->name }}</p>
            <p><strong>Sector:</strong> {{ $opportunity->endUser->organisation_type }}</p>
            <p><strong>Contact Name:</strong> {{ $opportunity->endUser->contact_name }}</p>
            <p><strong>Contact Number:</strong> {{ $opportunity->endUser->contact_number }}</p>
            <p><strong>Contact Email:</strong> {{ $opportunity->endUser->contact_email }}</p>
            @if($opportunity->endUser->contact_job_title !== null)
                <p><strong>Contact Job Title:</strong> {{ $opportunity->endUser->contact_job_title }}</p>
            @endif
        </div>
        <div class="col-xs-12 col-md-6">
            <p>
                <strong>Address:</strong><br/>
                {{ $opportunity->endUser->address_line_1 }} <br/>
                @if($opportunity->endUser->address_line_2 !== null)
                    {{ $opportunity->endUser->address_line_2 }} <br/>
                @endif
                {{ $opportunity->endUser->county }} <br/>
                {{ $opportunity->endUser->city }} <br/>
                {{ $opportunity->endUser->postcode }} <br/>
                {{ $opportunity->endUser->country }} <br/>
            </p>
        </div>
    </div>
</div>



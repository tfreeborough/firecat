<div id="my_information">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="title">My Information</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p><strong>Name:</strong> {{ $opportunity->partner->first_name }} {{ $opportunity->partner->last_name }}</p>
            <p><strong>Email:</strong> {{ $opportunity->partner->email }}</p>
            @if($opportunity->partner->extra->second_email !== null)
                <p><strong>Secondary Email:</strong> {{ $opportunity->partner->extra->second_email }}</p>
            @else
                <p><strong>Secondary Email:</strong> <a href="{{ route('partner.account') }}">Add here</a></p>
            @endif
            @if($opportunity->partner->extra->work_number !== null)
                <p><strong>Work Phone:</strong> {{ $opportunity->partner->extra->work_number }}</p>
            @else
                <p><strong>Work Phone:</strong> <a href="{{ route('partner.account') }}">Add here</a></p>
            @endif
            @if($opportunity->partner->extra->mobile_number !== null)
                <p><strong>Mobile Phone:</strong> {{ $opportunity->partner->extra->mobile_number }}</p>
            @else
                <p><strong>Mobile Phone:</strong> <a href="{{ route('partner.account') }}">Add here</a></p>
            @endif
        </div>
        <div class="col-xs-12 col-sm-8">
            <div class="alert alert-info">
                <p>
                    Firecat lets you add additional information such a phone numbers for vendors to contact you on, you can make these changes
                    through your <a href="{{ route('partner.account') }}">account.</a>
                </p>
            </div>
            <div class="alert alert-warning">
                <p>
                    When updating additional information on your profile, all of your opportunities and deals will also update.
                </p>
            </div>
        </div>
    </div>
</div>
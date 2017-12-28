<div id="partner_information" class="block">
    <h3 class="title">Partner Information</h3>
    <div id="partner_information_wrapper">
        <div id="partner_information_wrapper_first">
            @if(!$opportunity->partner->extra->avatar_url)
                <div class="avatar">
                    <img src="/images/avatar.png" />
                </div>
            @endif
            <div class="avatar"></div>
        </div>
        <div id="partner_information_wrapper_second">
            @if(!$user->isAssigned($opportunity->id))
                <p>
                    Non assigned members cannot view partner information on this opportunity, assign yourself first.
                </p>
            @else
                <table id="partner-contact-information" class="table table-striped">
                    <tbody>
                    <tr>
                        <td>Name:</td>
                        <td>{{ $opportunity->partner->name() }}</td>
                    </tr>
                    <tr>
                        <td>Primary Email:</td>
                        <td>{{ $opportunity->partner->email }}</td>
                    </tr>
                    <tr>
                        <td>Secondary Email:</td>
                        <td>{{ $opportunity->partner->extra->second_email }}</td>
                    </tr>
                    <tr>
                        <td>Work Phone:</td>
                        <td>{{ $opportunity->partner->extra->work_number }}</td>
                    </tr>
                    <tr>
                        <td>Mobile Phone:</td>
                        <td>{{ $opportunity->partner->extra->mobile_number }}</td>
                    </tr>
                    <tr>
                        <td>Last Login:</td>
                        <td>{{ \Carbon\Carbon::parse($opportunity->partner->last_login)->toDayDateTimeString() }}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</div>
<h3 class="title">Partner Information</h3>
<div class="row">
    <div class="col-xs-12 col-lg-12 text-center">
        @if(!$opportunity->partner->extra->avatar_url)
            <div class="avatar">
                <img src="/images/avatar.png" />
            </div>
        @endif
        <div class="avatar"></div>
        <h3>{{ $opportunity->partner->first_name }} {{ $opportunity->partner->last_name }}</h3>
    </div>
    <div class="col-xs-12 col-lg-12">
        @if(!$user->isAssigned($opportunity->id))
            <div class="disabled">
                <div class="disabled-block">
                    <p>
                        Non assigned members cannot view partner information on this opportunity, assign yourself first.
                    </p>
                </div>
            </div>
        @else
            <table id="partner-contact-information" class="table">
                <tbody>
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
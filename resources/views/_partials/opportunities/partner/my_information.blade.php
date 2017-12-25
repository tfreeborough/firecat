<div id="my_information" class="block">
    <h3 class="title">My Information</h3>
    <div id="my_information_wrapper">
        <div id="my_information_first">
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
                    @if($opportunity->partner->extra->second_email !== null)
                        <td>{{ $opportunity->partner->extra->second_email }}</td>
                    @else
                        <td><a href="{{ route('partner.account') }}">Add here</a></td>
                    @endif
                </tr>
                <tr>
                    <td>Work Phone:</td>
                    @if($opportunity->partner->extra->work_number !== null)
                        <td>{{ $opportunity->partner->extra->work_number }}</td>
                    @else
                        <td><a href="{{ route('partner.account') }}">Add here</a></td>
                    @endif
                </tr>
                <tr>
                    <td>Mobile Phone:</td>
                    @if($opportunity->partner->extra->mobile_number !== null)
                        <td>{{ $opportunity->partner->extra->mobile_number }}</td>
                    @else
                        <td><a href="{{ route('partner.account') }}">Add here</a></td>
                    @endif
                </tr>
                <tr>
                    <td>Last Login:</td>
                    <td>{{ \Carbon\Carbon::parse($opportunity->partner->last_login)->toDayDateTimeString() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div id="my_information_second">
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
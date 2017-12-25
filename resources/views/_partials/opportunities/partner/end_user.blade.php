<div id="end_user" class="block">
    <h3 class="title">End User</h3>
    <div id="end_user_wrapper">
        <div id="end_user_wrapper_first">
            <table id="end-user-information" class="table table-striped">
                <tbody>
                <tr>
                    <td>Organisation:</td>
                    <td>{{ $opportunity->endUser->name }}</td>
                </tr>
                <tr>
                    <td>Sector:</td>
                    <td>{{ $opportunity->endUser->organisation_type }}</td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td>{{ $opportunity->endUser->contact_name }}</td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>{{ $opportunity->endUser->contact_number }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $opportunity->endUser->contact_email }}</td>
                </tr>
                @if($opportunity->endUser->contact_job_title !== null)
                    <tr>
                        <td>Job Title:</td>
                        <td>{{ $opportunity->endUser->contact_job_title }}</td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
        <div id="end_user_wrapper_second">
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



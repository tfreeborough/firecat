<div id="opportunity_information" class="block">
    <h3 class="title">Opportunity Information</h3>
    <div id="opportunity_information_wrapper">
        <table id="opportunity-information" class="table table-striped">
            <thead>
            <tr>
                <th>Section</th>
                <th>Information</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>End User</td>
                <td>
                    <ul>
                        <li><strong>Name:</strong> {{ $opportunity->endUser->name }}</li>
                        <li><strong>Sector:</strong> {{ $opportunity->endUser->organisation_type }}</li>
                        <li><strong>Address Line 1:</strong> {{ $opportunity->endUser->address_line_1 }}</li>
                        <li><strong>City:</strong> {{ $opportunity->endUser->city }}</li>
                        <li><strong>County:</strong> {{ $opportunity->endUser->county }}</li>
                        <li><strong>Country:</strong> {{ $opportunity->endUser->country }}</li>
                    </ul>
                    <ul>
                        <li><strong>Name:</strong> {{ $opportunity->endUser->contact_name }}</li>
                        <li><strong>Email:</strong> {{ $opportunity->endUser->contact_email }}</li>
                        <li><strong>Telephone:</strong> {{ $opportunity->endUser->contact_number }}</li>
                        <li><strong>Job Title:</strong> {{ $opportunity->endUser->contact_job_title }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Project</td>
                <td>
                    <ul>
                        <li><strong>Name:</strong> {{ $opportunity->name }}</li>
                        <li><strong>Estimated Value:</strong> &pound;{{ number_format($opportunity->estimated_value/100,0) }}</li>
                        @if($opportunity->estimated_units)
                            <li><strong>Estimated Units:</strong> {{ $opportunity->estimated_units }}</li>
                        @else
                            <li><strong>Estimated Units:</strong> N/A</li>
                        @endif
                        @if($opportunity->date_of_award)
                            <li><strong>Date of Award:</strong> {{ \Carbon\Carbon::parse($opportunity->date_of_award)->toFormattedDateString() }}</li>
                        @else
                            <li><strong>Date of Award:</strong> N/A</li>
                        @endif
                        <li><strong>Implementation Date:</strong> {{ \Carbon\Carbon::parse($opportunity->implementation_date)->toFormattedDateString() }}</li>
                        <li><strong>Purchase Type:</strong> {{ $opportunity->purchase_type }}</li>
                        <li><strong>Type of Procurement:</strong> {{ $opportunity->procurement_type }}</li>
                        <li><strong>Direct/Indirect Procurement:</strong> {{ $opportunity->direct_indirect_procurement }}</li>
                    </ul>
                    <ul>
                        <li><strong>Competitors:</strong> {{ $opportunity->competitors }}</li>
                        <li><strong>Project Reference:</strong> {{ $opportunity->reference }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Justification</td>
                <td>
                    <ul>
                        <blockquote id="justification">
                            <i>{{ $opportunity->justification }}</i>
                        </blockquote>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


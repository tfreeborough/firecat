<div id="opportunity_information" class="block">
    <h3 class="title">Opportunity Information</h3>
    <div id="opportunity_information_wrapper">
        <div id="opportunity-created-bar">
            <h4>This opportunity was created <strong>{{ \Carbon\Carbon::parse($opportunity->created_at)->diffForHumans() }}</strong></h4>
        </div>
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
                        @if(!$user->isAssigned($opportunity->id))
                            <li class="more-info"><i>More information when you are assigned to this opportunity</i></li>
                        @else
                            <li><strong>Address Line 1:</strong> {{ $opportunity->endUser->address_line_1 }}</li>
                            <li><strong>City:</strong> {{ $opportunity->endUser->city }}</li>
                            <li><strong>County:</strong> {{ $opportunity->endUser->county }}</li>
                            <li><strong>Country:</strong> {{ $opportunity->endUser->country }}</li>
                        @endif
                    </ul>
                    <ul>
                        @if(!$user->isAssigned($opportunity->id))
                            <li class="more-info"><i>More information when you are assigned to this opportunity</i></li>
                        @else
                            <li><strong>Name:</strong> {{ $opportunity->endUser->contact_name }}</li>
                            <li><strong>Email:</strong> {{ $opportunity->endUser->contact_email }}</li>
                            <li><strong>Telephone:</strong> {{ $opportunity->endUser->contact_number }}</li>
                            <li><strong>Job Title:</strong> {{ $opportunity->endUser->contact_job_title }}</li>
                        @endif
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
                        @if(!$user->isAssigned($opportunity->id))
                            <li class="more-info"><i>More information when you are assigned to this opportunity</i></li>
                        @else
                            @if($opportunity->date_of_award)
                                <li><strong>Date of Award:</strong> {{ \Carbon\Carbon::parse($opportunity->date_of_award)->toFormattedDateString() }}</li>
                            @else
                                <li><strong>Date of Award:</strong> N/A</li>
                            @endif
                            <li><strong>Implementation Date:</strong> {{ \Carbon\Carbon::parse($opportunity->implementation_date)->toFormattedDateString() }}</li>
                            <li><strong>Purchase Type:</strong> {{ $opportunity->purchase_type }}</li>
                            <li><strong>Type of Procurement:</strong> {{ $opportunity->procurement_type }}</li>
                            <li><strong>Direct/Indirect Procurement:</strong> {{ $opportunity->direct_indirect_procurement }}</li>
                        @endif
                    </ul>
                    <ul>
                        @if(!$user->isAssigned($opportunity->id))
                            <li class="more-info"><i>More information when you are assigned to this opportunity</i></li>
                        @else
                            <li><strong>Competitors:</strong> {{ $opportunity->competitors }}</li>
                            <li><strong>Project Reference:</strong> {{ $opportunity->reference }}</li>
                        @endif
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Justification</td>
                <td>
                    <ul>
                        @if(!$user->isAssigned($opportunity->id))
                            <li class="more-info"><i>More information when you are assigned to this opportunity</i></li>
                        @else
                            <blockquote id="justification">
                                <i>{{ $opportunity->justification }}</i>
                            </blockquote>
                        @endif
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


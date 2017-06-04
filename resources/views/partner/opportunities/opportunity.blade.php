@extends('app')

@section('title', "$opportunity->name")

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">

        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $opportunity->name }}</h1>
            <h5 id="page-subtitle"><strong>Vendor:</strong> {{ $opportunity->organisation->name }} | <strong>End User:</strong> {{ $opportunity->endUser->name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('partner.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('partner.opportunities')}}">
                            Opportunities
                        </a>
                    </li>
                    <li>
                        {{ $opportunity->name }}
                    </li>
                </ul>
            </div>
        </div>
        <div id="opportunity">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    @include('_partials.opportunities.status_code_display')
                    <h3>My Information</h3>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
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
                <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12">
                        <h3>End User</h3>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <p><strong>Name:</strong> {{ $opportunity->endUser->name }}</p>
                        <p><strong>Sector:</strong> {{ $opportunity->endUser->organisation_type }}</p>
                        <p><strong>Contact Name:</strong> {{ $opportunity->endUser->contact_name }}</p>
                        <p><strong>Contact Number:</strong> {{ $opportunity->endUser->contact_number }}</p>
                        <p><strong>Contact Email:</strong> {{ $opportunity->endUser->contact_email }}</p>
                        @if($opportunity->endUser->contact_job_title !== null)
                            <p><strong>Contact Job Title:</strong> {{ $opportunity->endUser->contact_job_title }}</p>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-6">
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
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h3>Opportunity Information</h3>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            @if($opportunity->reference !== null)
                                <p><strong>Reference:</strong> {{ $opportunity->reference }}</p>
                            @endif
                                <p><strong>Purchase Type:</strong> {{ $opportunity->purchase_type }}</p>
                                <p><strong>Type of Procurement:</strong> {{ $opportunity->procurement_type }}</p>
                            @if($opportunity->competitors !== null)
                                <p><strong>Competitors:</strong> {{ $opportunity->competitors }}</p>
                            @endif
                        </div>
                        <div class="col-xs-12 col-md-6">
                            @if($opportunity->date_of_award !== null)
                                <p><strong>Date of Award:</strong> {{ \Carbon\Carbon::parse($opportunity->date_of_award)->toDayDateTimeString() }}</p>
                            @endif
                            <p><strong>Implementation Date:</strong> {{ \Carbon\Carbon::parse($opportunity->implementation)->toDayDateTimeString() }}</p>
                            <p><strong>Direct/Indirect Procurement:</strong> {{ $opportunity->direct_indirect_procurement }}</p>
                        </div>
                    </div>
                    <table id="opportunity-value-table" class="table">
                        <thead>
                        <tr>
                            <th>Estimated Value</th>
                            <th>Estimated Units</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>&pound;{{ number_format($opportunity->estimated_value/100,2) }}</td>
                            <td>{{ number_format($opportunity->estimated_units,0) }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-xs-12">
                            <p><strong>Justification:</strong></p>
                            <p>
                                {{ $opportunity->justification }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <h3>Products</h3>
                    <table id="opportunity-product-table" class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($opportunity->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button onClick="confirmDelete()" class="button pull-right">Delete this Opportunity</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function confirmDelete(){
            vex.dialog.confirm({
                message: 'Are you sure? Once you delete this opportunity you will not be able to undo this action. You will also undo any progress the vendor may have made.',
                callback: function (value) {
                    if(value){
                        window.location.href = '/partner/opportunities/{{$opportunity->id}}/delete'
                    }
                }
            })
        }
    </script>
@endsection
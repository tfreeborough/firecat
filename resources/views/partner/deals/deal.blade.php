@extends('app')

@section('title', "$deal->opportunity->name")

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">

        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $deal->opportunity->name }}</h1>
            <h5 id="page-subtitle"><strong>Vendor:</strong> {{ $deal->opportunity->organisation->name }} | <strong>End User:</strong> {{ $deal->opportunity->endUser->name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('partner.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('partner.deals')}}">
                            Deals
                        </a>
                    </li>
                    <li>
                        {{ $deal->opportunity->name }}
                    </li>
                </ul>
            </div>
        </div>
        <div id="deal">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h3>My Information</h3>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <p><strong>Name:</strong> {{ $deal->opportunity->partner->first_name }} {{ $deal->opportunity->partner->last_name }}</p>
                            <p><strong>Email:</strong> {{ $deal->opportunity->partner->email }}</p>
                            @if($deal->opportunity->partner->extra->second_email !== null)
                                <p><strong>Secondary Email:</strong> {{ $deal->opportunity->partner->extra->second_email }}</p>
                            @else
                                <p><strong>Secondary Email:</strong> <a href="{{ route('partner.account') }}">Add here</a></p>
                            @endif
                            @if($deal->opportunity->partner->extra->work_number !== null)
                                <p><strong>Work Phone:</strong> {{ $deal->opportunity->partner->extra->work_number }}</p>
                            @else
                                <p><strong>Work Phone:</strong> <a href="{{ route('partner.account') }}">Add here</a></p>
                            @endif
                            @if($deal->opportunity->partner->extra->mobile_number !== null)
                                <p><strong>Mobile Phone:</strong> {{ $deal->opportunity->partner->extra->mobile_number }}</p>
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
                        <p><strong>Name:</strong> {{ $deal->opportunity->endUser->name }}</p>
                        <p><strong>Sector:</strong> {{ $deal->opportunity->endUser->organisation_type }}</p>
                        <p><strong>Contact Name:</strong> {{ $deal->opportunity->endUser->contact_name }}</p>
                        <p><strong>Contact Number:</strong> {{ $deal->opportunity->endUser->contact_number }}</p>
                        <p><strong>Contact Email:</strong> {{ $deal->opportunity->endUser->contact_email }}</p>
                        @if($deal->opportunity->endUser->contact_job_title !== null)
                            <p><strong>Contact Job Title:</strong> {{ $deal->opportunity->endUser->contact_job_title }}</p>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <p>
                            <strong>Address:</strong><br/>
                            {{ $deal->opportunity->endUser->address_line_1 }} <br/>
                            @if($deal->opportunity->endUser->address_line_2 !== null)
                                {{ $deal->opportunity->endUser->address_line_2 }} <br/>
                            @endif
                            {{ $deal->opportunity->endUser->county }} <br/>
                            {{ $deal->opportunity->endUser->city }} <br/>
                            {{ $deal->opportunity->endUser->postcode }} <br/>
                            {{ $deal->opportunity->endUser->country }} <br/>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h3>Deal Information</h3>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            @if($deal->opportunity->reference !== null)
                                <p><strong>Reference:</strong> {{ $deal->opportunity->reference }}</p>
                            @endif
                            <p><strong>Purchase Type:</strong> {{ $deal->opportunity->purchase_type }}</p>
                            <p><strong>Type of Procurement:</strong> {{ $deal->opportunity->procurement_type }}</p>
                            @if($deal->opportunity->competitors !== null)
                                <p><strong>Competitors:</strong> {{ $deal->opportunity->competitors }}</p>
                            @endif
                        </div>
                        <div class="col-xs-12 col-md-6">
                            @if($deal->opportunity->date_of_award !== null)
                                <p><strong>Date of Award:</strong> {{ \Carbon\Carbon::parse($deal->opportunity->date_of_award)->toDayDateTimeString() }}</p>
                            @endif
                            <p><strong>Implementation Date:</strong> {{ \Carbon\Carbon::parse($deal->opportunity->implementation)->toDayDateTimeString() }}</p>
                            <p><strong>Direct/Indirect Procurement:</strong> {{ $deal->opportunity->direct_indirect_procurement }}</p>
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
                            <td>&pound;{{ number_format($deal->opportunity->estimated_value/100,2) }}</td>
                            <td>{{ number_format($deal->opportunity->estimated_units,0) }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-xs-12">
                            <p><strong>Justification:</strong></p>
                            <p>
                                {{ $deal->opportunity->justification }}
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
                        @foreach($deal->opportunity->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
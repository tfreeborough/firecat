@extends('app')

@section('title', $opportunity->name)

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $opportunity->name }}</h1>
            <h5 id="page-subtitle">Submitted by {{ $opportunity->partner->first_name }} {{ $opportunity->partner->last_name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vendor.opportunities')}}">
                        Opportunities
                        </a>
                    </li>
                    <li>
                        {{ $opportunity->name }}
                    </li>
                </ul>
            </div>
        </div>
        <div id="vendor-opportunity">
            <div class="row">
                <div class="col-xs-12">
                    @include('_partials.opportunities.status_code_display')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <h3 class="title">Assignments</h3>
                    <div class="row">
                        <div class="col-xs-12">
                            <p>Any members of {{ $user->organisation->name }} that are assigned to this opportunity will show here when they are made.</p>
                        </div>
                        @foreach($opportunity->assignees as $assignee)
                            <div class="assignment-block col-xs-12 col-sm-6 col-md-4">
                                <img src={{ $assignee->user->extra->avatar_url }} />
                                <p>{{ $assignee->user->first_name }} {{ $assignee->user->last_name }}</p>
                            </div>
                        @endforeach
                        @if(count($opportunity->assignees) === 0)
                            <div class="col-xs-12">
                                <p><strong>Nobody is currently assigned to this opportunity</strong></p>
                            </div>
                        @endif
                    </div>
                    @if(!$user->isAssigned($opportunity->id))
                        <button onClick="assignmentConfirm()" class="button action">Assign me to this opportunity</button>
                    @endif
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <h3 class="title">Latest Messages</h3>
                    @if(Auth::user()->isAssigned($opportunity->id))
                        <div>
                            <p>Authorized</p>
                        </div>
                    @else
                        <div class="disabled">
                            <div class="disabled-block">
                                <p>
                                    Non assigned members cannot view internal messaging, assign yourself to this opportunity if you wish to contribute.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 col-md-12 col-lg-4">
                    <h3 class="title">Activity</h3>
                    @if(Auth::user()->isAssigned($opportunity->id))
                        <div>
                            <p>Authorized</p>
                        </div>
                    @else
                        <div class="disabled">
                            <div class="disabled-block">
                                <p>
                                    Non assigned members cannot view activity on this opportunity, assign yourself to view activity.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div id="partner-information" class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                    <h3 class="title">Partner Information</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-6 text-center">
                            @if(!$opportunity->partner->extra->avatar_url)
                                <div class="avatar">
                                    <img src="/images/avatar.png" />
                                </div>
                            @endif
                            <div class="avatar"></div>
                            <h3>{{ $opportunity->partner->first_name }} {{ $opportunity->partner->last_name }}</h3>
                        </div>
                        <div class="col-xs-12 col-lg-6">
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
                    <h3 class="title">Products</h3>
                    <div class="row">
                        <div class="col-xs-12">
                            @if(!$user->isAssigned($opportunity->id))
                                <div class="disabled">
                                    <div class="disabled-block text-center">
                                        <p>
                                            You cannot view any products in this opportunity until you assign to this opportunity
                                        </p>
                                        <div>
                                            <button onClick="assignmentConfirm()" class="button">Assign me to this opportunity</button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <table id="product-table" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            Product
                                        </th>
                                        <th>
                                            Quantity/Size/Model
                                        </th>
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
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                    <h3 class="title">Opportunity Information</h3>
                    <div id="opportunity-created-bar">
                        <h5>This opportunity was created <strong>{{ \Carbon\Carbon::parse($opportunity->created_at)->diffForHumans() }}</strong></h5>
                    </div>
                    <table id="opportunity-information" class="table">
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>End User - Organisation</td>
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
                                </td>
                            </tr>
                            <tr>
                                <td>End User - Contact</td>
                                <td>
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
                                <td>Project - Primary Information</td>
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
                                </td>
                            </tr>
                            <tr>
                                <td>Project - Additional</td>
                                <td>
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
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function assignmentConfirm()
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to assign youself to this opportunity, you will not be able to undo this action?',
                callback: function (value) {
                    if (value) {
                        window.location.href = '/vendor/opportunities/{{$opportunity->id}}/assign';
                    }
                }
            })
        }

        $(document).ready(function(){
            @if($opportunity->partner->extra->avatar_id)
                $('#partner-information .avatar').html($.cloudinary.image('{{ $opportunity->partner->extra->avatar_id }}', { width: 128, height: 128, crop: 'fill', gravity: 'face' }));
            @endif
        });
    </script>
@endsection
@extends('app')

@section('title', "$opportunity->name")

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
        @include('_partials.flash_message')
        <div id="opportunity">
            <div id="opportunity_converted">
                @if($opportunity->deal !== null)
                    <div class="alert alert-success">
                        <p>
                            This opportunity has been converted to a deal registration, you can view that by clicking on the button below |
                            <a href="/partner/deals/{{$opportunity->deal->id}}">
                                View Deal Registration
                            </a>
                        </p>
                    </div>
                @endif
                @if($opportunity->isRejected())
                    <div class="alert alert-danger">
                        <h4>
                            This opportunity has been rejected
                        </h4>
                        <p>
                            <strong>Reason:</strong> {{ $opportunity->rejectionReasoning() }}
                        </p>
                    </div>
                @endif
            </div>
            @include('_partials.opportunities.status_code_display')
            @include('_partials.opportunities.partner.vendor_consultation')
            @include('_partials.opportunities.partner.my_information')
            @include('_partials.opportunities.partner.end_user')
            @include('_partials.opportunities.partner.opportunity_information')
            @include('_partials.opportunities.partner.opportunity_products')
            <div id="opportunity_delete">
                @if($opportunity->deal === null)
                    <!-- <button onClick="confirmDelete()" class="button pull-right">Delete this Opportunity</button> -->
                @else
                    <a href="{{ route('partner.deal',$opportunity->deal->id) }}"><button class="button pull-right">View Deal</button></a>
                @endif
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
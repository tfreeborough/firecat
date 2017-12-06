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
            @if($opportunity->deal !== null)
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-left">
                            <div class="alert alert-success">
                                <p>
                                    This opportunity has been converted to a deal registration, you can view that by clicking on the button below |
                                    <a href="/partner/deals/{{$opportunity->deal->id}}">
                                        View Deal Registration
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    @include('_partials.opportunities.status_code_display')
                </div>
                <div class="col-xs-12 col-md-6">
                    @include('_partials.opportunities.partner.vendor_consultation')
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    @include('_partials.opportunities.partner.my_information')
                </div>
                <div class="col-xs-12 col-md-6">
                    @include('_partials.opportunities.partner.end_user')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    @include('_partials.opportunities.partner.opportunity_information')
                </div>
                <div class="col-xs-12 col-md-6">
                    @include('_partials.opportunities.partner.opportunity_products')
                </div>
            </div>
            @if($opportunity->deal === null)
            <div class="row">
                <div class="col-xs-12">
                    <button onClick="confirmDelete()" class="button pull-right">Delete this Opportunity</button>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-xs-12">
                        <a href="{{ route('partner.deal',$opportunity->deal->id) }}"><button class="button pull-right">View Deal</button></a>
                    </div>
                </div>
            @endif
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
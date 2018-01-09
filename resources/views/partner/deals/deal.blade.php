@extends('app')

@section('title', $deal->opportunity->name)

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
        @include('_partials.flash_message')
        <div id="partner_deal">
            <div id="deal_actions" class="block">
                <a href="{{route('partner.opportunity',$deal->opportunity->id)}}">
                    <i class="fa fa-file-text" aria-hidden="true" title="View Opportunity"></i>
                </a>
                <a href="{{route('partner.opportunity',$deal->opportunity->id)}}">
                    <i class="fa fa-envelope-o" aria-hidden="true" title="Email to me"></i>
                </a>
            </div>
            @include('_partials.deals.partner.deal_status')
            @include('_partials.deals.partner.deal_implementation')
            @include('_partials.deals.partner.deal_updates')
            @include('_partials.opportunities.partner.my_information')
            @include('_partials.opportunities.partner.end_user')
            @include('_partials.opportunities.partner.opportunity_information')
            @include('_partials.opportunities.partner.opportunity_products')
        </div>
    </div>
@endsection


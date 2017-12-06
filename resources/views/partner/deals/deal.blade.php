@extends('app')

@section('title', $deal->opportunity->name)

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
        <div id="partner_deal">
            <div class="row">
                <div id="deal_actions" class="col-xs-12">
                    <a class="pull-right" href="{{route('partner.opportunity',$deal->opportunity->id)}}">
                        <button class="button">View Opportunity</button>
                    </a>
                    <div class="pull-right">
                        <button class="button">Email to me</button>
                    </div>
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
        </div>
    </div>
@endsection
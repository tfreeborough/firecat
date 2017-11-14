@extends('app')

@section('title', $deal->opportunity->name)

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $deal->opportunity->name }}</h1>
            <h5 id="page-subtitle">Submitted by {{ $deal->opportunity->partner->first_name }} {{ $deal->opportunity->partner->last_name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vendor.deals')}}">
                            Deals
                        </a>
                    </li>
                    <li>
                        {{ $deal->opportunity->name }}
                    </li>
                </ul>
            </div>
        </div>
        <div id="vendor-opportunity">
            @include('_partials.errors')
            @if($deal->opportunity->status->in_review)
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-4">
                        @if(!$deal->opportunity->status->accepted)
                            <div class="alert alert-danger">
                                <p>
                                    This opportunity is currently in review, please ensure all considerations have been achieved
                                    then you will be able to convert this opportunity into a deal registration.
                                </p>
                            </div>
                        @endif
                        @include('_partials.opportunities.status_code_display')
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-xs-12">
                        @include('_partials.opportunities.status_code_display')
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    @include('_partials.opportunities.vendor.assignments_panel')
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    @include('_partials.opportunities.vendor.internal_messaging_panel')
                </div>
                <div class="col-xs-12 col-md-12 col-lg-4">
                    @include('_partials.opportunities.vendor.activity_panel');
                </div>
            </div>
            <div class="row">
                <div id="partner-information" class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    @include('_partials.opportunities.vendor.opportunity_products');
                    @include('_partials.opportunities.vendor.partner_information');
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    @include('_partials.opportunities.vendor.opportunity_information');
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var element = document.querySelector("#opportunity-messages ul");
        element.scrollTop = element.scrollHeight;

        function assignmentConfirm()
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to assign youself to this opportunity, you will not be able to undo this action?',
                callback: function (value) {
                    if (value) {
                        window.location.href = '/vendor/opportunities/{{$deal->opportunity->id}}/assign';
                    }
                }
            })
        }

        $(document).ready(function(){
            @if($deal->opportunity->partner->extra->avatar_id)
                $('#partner-information .avatar').html($.cloudinary.image('{{ $deal->opportunity->partner->extra->avatar_id }}', { width: 128, height: 128, crop: 'fill', gravity: 'face' }));
            @endif
        });
    </script>
@endsection
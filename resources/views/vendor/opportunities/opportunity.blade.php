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
            @include('_partials.errors')
            <div class="row">
                <div class="col-xs-12">
                    @include('_partials.opportunities.status_code_display')
                </div>
            </div>
            @if($opportunity->status->in_review)
            <div class="row">
                <div class="col-xs-12">
                    @include('_partials.opportunities.vendor.review_panel')
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
                <div id="partner-information" class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                    @include('_partials.opportunities.vendor.partner_information');
                    @include('_partials.opportunities.vendor.opportunity_products');
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
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
@extends('app')

@section('title', $opportunity->name)

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
        @include('_partials.errors')
        <div id="vendor-opportunity">
            <div id="opportunity_converted">
                @if(!$user->isAssigned($opportunity->id))
                    <div class="alert alert-info">
                        <p>
                            You are not assigned to this opportunity. if you wish to interact and view more information please assign yourself first
                        </p>
                    </div>
                @endif
                @if($opportunity->deal !== null)
                    <div class="alert alert-success">
                        <p>
                            This opportunity has been converted to a deal registration, you can view that by clicking the following link. |
                            <a href="/vendor/deals/{{$opportunity->deal->id}}">
                                View Deal Registration
                            </a>
                        </p>
                    </div>
                @endif
            </div>
            @if($opportunity->status->in_review)
                @include('_partials.opportunities.status_code_display')
                @include('_partials.opportunities.vendor.review_panel')
                @include('_partials.opportunities.vendor.partner_consultation')
            @else
                @include('_partials.opportunities.status_code_display')
            @endif

            @include('_partials.opportunities.vendor.partner_information')
            @include('_partials.opportunities.vendor.opportunity_information')
            @include('_partials.opportunities.vendor.internal_messaging_panel')
            @include('_partials.opportunities.vendor.activity_panel')
            @include('_partials.opportunities.vendor.assignments_panel')
            @include('_partials.opportunities.vendor.opportunity_products')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var element = document.querySelector("#opportunity-messages ul");
        element.scrollTop = element.scrollHeight;

        $(document).ready(function(){
            @if($opportunity->partner->extra->avatar_id)
                $('#partner-information .avatar').html($.cloudinary.image('{{ $opportunity->partner->extra->avatar_id }}', { width: 128, height: 128, crop: 'fill', gravity: 'face' }));
            @endif
        });
    </script>
@endsection
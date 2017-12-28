@extends('app')

@section('title', $deal->opportunity->name)

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
        @include('_partials.flash_message')
        <div id="vendor-deal">
            @include('_partials.deals.vendor.deal_status')
            @include('_partials.deals.vendor.deal_implementation')
            @include('_partials.deals.vendor.deal_updates')
            @include('_partials.opportunities.vendor.opportunity_products')
            @include('_partials.opportunities.vendor.partner_information')
            @include('_partials.opportunities.vendor.opportunity_information')
            @include('_partials.opportunities.vendor.assignments_panel')
            @include('_partials.opportunities.vendor.internal_messaging_panel')
            @include('_partials.opportunities.vendor.activity_panel')
            @include('_partials.opportunities.vendor.partner_consultation')
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
                message: 'Are you sure you want to assign yourself to this opportunity, you will not be able to undo this action?',
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
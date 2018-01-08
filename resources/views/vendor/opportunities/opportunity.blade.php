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
        @include('_partials.flash_message')
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
                @if($opportunity->status->getStatusCode() === 3 && !$opportunity->isRejected())
                    <div class="text-right">
                        <button onclick="rejectConfirm()" class="button">Reject Opportunity</button>
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
            @include('_partials.opportunities.vendor.review_panel')
            @include('_partials.opportunities.vendor.partner_consultation')
            @include('_partials.opportunities.vendor.partner_information')
            @include('_partials.opportunities.vendor.opportunity_information')
            @include('_partials.opportunities.vendor.internal_messaging_panel')
            @include('_partials.opportunities.vendor.activity_panel')
            @include('_partials.opportunities.vendor.assignments_panel')
            @include('_partials.opportunities.vendor.opportunity_products')
        </div>
    </div>
    <script>
        function rejectConfirm()
        {
            vex.dialog.open({
                message: 'Pick a reason for this rejection:',
                input: [
                    '<select name="reason" required />',
                    '<option value="Known opportunity, Vendor is aware, Deal registration will not be given">Known opportunity, Vendor is aware, Deal registration will not be given</option>',
                    '<option value="Public Tender , pricing will be issued on a level basis to all partners">Public Tender , pricing will be issued on a level basis to all partners</option>',
                    '<option value="Below qualifying volumes please use standard pricing">Below qualifying volumes please use standard pricing</option>',
                    '<option value="Cannot meet the requirements">Cannot meet the requirements</option>',
                    '<option value="Deal registration given to another partner">Deal registration given to another partner</option>',
                    '</select />',
                ].join(''),
                buttons: [
                    $.extend({}, vex.dialog.buttons.YES, { text: 'Submit' }),
                    $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
                ],
                callback: function (data) {
                    if (data) {
                        vex.dialog.confirm({
                            message: 'Are you sure you want to reject this opportunity? You will not longer be able to make changes afterwards',
                            callback: function (value) {
                                if (value) {
                                    window.location.href = '{{ route('vendor.opportunity.reject', $opportunity->id) }}?reason='+data.reason;
                                }
                            }
                        })
                    }
                }
            });

        }
    </script>
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
<div id="opportunity_review_panel" class="block">
    <h3 class="title">Considerations</h3>
    <div id="opportunity_review_panel_wrapper">
        <div id="opportunity_review_panel_first">
            @if(!$user->isAssigned($opportunity->id))
                <p>
                    Non assigned members cannot view considerations on this opportunity, assign yourself first.
                </p>
            @elseif(!$opportunity->status->in_review)
                <p>Considerations will become available when this opportunity is in review.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Considerations</th>
                        <th>Achieved</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($opportunity->considerations as $consideration)
                        <tr>
                            <td>
                                {{ $consideration->title }}
                                @if(!$consideration->achieved)
                                    <br /><small><a href="{{ route('vendor.opportunity.consideration.complete', [$opportunity->id, $consideration->id]) }}">Mark as complete</a></small>
                                @endif
                            </td>
                            <td>
                                @if($consideration->achieved)
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-question" aria-hidden="true"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if(count($opportunity->considerations) === 0)
                        <tr>
                            <td>No considerations are required for this opportunity</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            @endif

            <a class="pull-right" href="{{ route('docs.opportunities.considerations') }}">
                <small>Learn more about considerations</small>
            </a>
        </div>
        <div id="opportunity_review_panel_second">
            <table id="consideration-complete-table" class="table">
                <tbody>
                <tr>
                    <td>
                        <h3>{{ $opportunity->getConsiderationsCompleted() }}/{{ count($opportunity->considerations) }}</h3>
                        <small>Considerations achieved</small>
                    </td>
                    <td>
                        @if($user->isAssigned($opportunity->id) && $opportunity->getConsiderationsCompleted() === count($opportunity->considerations))
                            @if($opportunity->deal !== null)
                                <button class="button disabled">Converted to Deal Registration</button>
                            @else
                                <button class="button action" onClick="confirmDealRegistration()">Convert to Deal Registration</button>
                            @endif

                        @else
                            <button class="button disabled">Convert to Deal Registration</button>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        function confirmDealRegistration(){
            vex.dialog.confirm({
                message: 'Are you sure you want to convert this opportunity into a deal registration? This cannot be undone.',
                callback: function (value) {
                    if(value){
                        $.ajax({
                            type: "POST",
                            url: '/vendor/opportunities/{{ $opportunity->id }}/convert',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response){
                                location.reload();
                            },
                        }).fail(function(err){
                            console.log(err);
                            vex.dialog.alert({
                                message: 'ERROR: '+err.responseText,
                            });
                        });
                    }
                }
            })
        }
    </script>
@endsection

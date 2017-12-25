<div id="deal_updates" class="block">
    <h3 class="title">Proposed Updates</h3>
    <div id="deal_updates_wrapper">
        @foreach($deal->updates as $deal_update)
            <div class="deal_update">
                <p>
                    <strong>{{ $deal_update->user->name() }}</strong> would like to modify the <strong>{{ $deal_update->type_formatted }}</strong> to <strong>{{ $deal_update->proposal }}</strong>
                </p>
                <div class="deal_update_actions">
                    <a href="{{ route('vendor.deal.update.accept', [$deal->id, $deal_update->id]) }}"><i class="fa fa-check green" aria-hidden="true" title="Accept Proposal"></i></a>
                    <a href="{{ route('vendor.deal.update.reject', [$deal->id, $deal_update->id]) }}"><i class="fa fa-times red" aria-hidden="true" title="Reject Proposal"></i></a>
                </div>
            </div>
        @endforeach
        @if(count($deal->updates) === 0)
            <p>
                There are no new proposed updates for this deal
            </p>
        @endif
    </div>
</div>
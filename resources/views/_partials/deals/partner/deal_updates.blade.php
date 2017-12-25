<div id="deal_updates" class="block">
    <h3 class="title">Proposed Updates</h3>
    <div id="deal_updates_wrapper">
        @foreach($deal->updates as $deal_update)
            <div class="deal_update">
                <p>
                    <strong>{{ $deal_update->user->name() }}</strong> would like to modify the <strong>{{ $deal_update->type_formatted }}</strong> to <strong>{{ $deal_update->proposal }}</strong>
                </p>
            </div>
        @endforeach
        @if(count($deal->updates) === 0)
            <p>
                There are no new proposed updates for this deal
            </p>
        @endif
    </div>
</div>
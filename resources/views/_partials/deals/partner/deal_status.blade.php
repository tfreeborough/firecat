@if($deal->status->pending)
    <div id="deal_status" class="block pending">
        <div>
            Deal Pending
        </div>
    </div>
@else
    @if($deal->status->won)
        <div id="deal_status" class="block won">
            <div>
                Deal Won
            </div>
        </div>
    @else
        <div id="deal_status" class="block lost">
            <div>
                Deal Lost
            </div>
        </div>
    @endif
@endif

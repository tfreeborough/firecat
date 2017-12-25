<div id="deal_implementation">
    <div id="deal_implementation_wrapper" class="block">
        <div>
            <p class="implementation_title">Implementation Date</p>
            <p class="implementation_date">{{ \Carbon\Carbon::parse($deal->opportunity->implementation_date)->toFormattedDateString() }}</p>
            <p class="implementation_diff">
                @if(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($deal->opportunity->implementation_date), false) < 0)
                    {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($deal->opportunity->implementation_date)) }} days ago.
                @else
                    {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($deal->opportunity->implementation_date)) }} days from now.
                @endif

            </p>
        </div>
    </div>
    @include('_partials.deals.partner.deal_status_actions')
</div>
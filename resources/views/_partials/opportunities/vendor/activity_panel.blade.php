<h3 class="title">Activity</h3>
<div id="opportunity-activity">
    <p>Hi {{ Auth::user()->first_name }}, here is the latest activity for this opportunity.</p>
    <ul>
        @foreach($opportunity->getRecentActivity() as $activity)
            <li>
                <p>
                    @if($activity->link && Auth::user()->isAssigned($opportunity->id))
                        <a href="{{$activity->link}}"><i class="fa fa-link" aria-hidden="true"></i></a>
                    @endif
                    {{ $activity->description }}
                </p>
                <p><small>{{ \Carbon\Carbon::parse($activity->create_at)->toFormattedDateString() }}</small></p>
            </li>
        @endforeach
    </ul>
    @if(Auth::user()->isAssigned($opportunity->id))
        <div id="button-wrapper">
            <a href="/vendor/opportunities/{{$opportunity->id}}/messages">
                <button class="button"><i class="fa fa-thumb-tack" aria-hidden="true"></i> View Full Activity</button>
            </a>
        </div>
    @endif
</div>
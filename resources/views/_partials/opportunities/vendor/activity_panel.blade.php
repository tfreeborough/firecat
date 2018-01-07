<div id="activity_panel" class="block">
    <h3 class="title">Activity</h3>
    <div id="activity_panel_wrapper">
        <p>Hi {{ Auth::user()->first_name }}, here is the latest activity for this opportunity.</p>
        <ul class="striped">
            @foreach($opportunity->getRecentActivity() as $activity)
                <li>
                    <p>
                        {{ $activity->description }}
                    </p>
                    <p>
                        <small>{{ \Carbon\Carbon::parse($activity->created_at)->toDayDateTimeString() }}</small>
                        @if($activity->link && Auth::user()->isAssigned($opportunity->id))
                            | <a href="{{$activity->link}}"><i class="fa fa-link" aria-hidden="true"></i></a>
                        @endif
                    </p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
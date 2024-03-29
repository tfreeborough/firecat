<div id="internal_messaging_panel" class="block">
    <h3 class="title">Internal Messaging</h3>
    <div id="internal_messaging_panel_wrapper">
        @if(Auth::user()->isAssigned($opportunity->id))
            <p>Click on each link to highlight the selected message.</p>
            <ul class="striped">
                @foreach($opportunity->getRecentMessages() as $message)
                    @if($message->isUser(Auth::user()->id))
                        <li class="me">
                            <p>
                                <strong>{{ $message->user->first_name }} {{ $message->user->last_name }}:</strong> {{ str_limit($message->message, $limit = 64, $end = '...') }}
                            </p>
                            <p>
                                <small>{{ \Carbon\Carbon::parse($message->created_at)->toFormattedDateString() }}</small> |
                                <a title="Permalink" href="/vendor/opportunities/{{$opportunity->id}}/messages#{{$message->id}}"><i class="fa fa-link" aria-hidden="true"></i></a>
                            </p>
                        </li>
                    @else
                        <li>
                            <p>
                                <strong>{{ $message->user->first_name }} {{ $message->user->last_name }}:</strong> {{ str_limit($message->message, $limit = 64, $end = '...') }}
                            </p>
                            <p>
                                <small>{{ \Carbon\Carbon::parse($message->created_at)->toFormattedDateString() }}</small>
                            </p>
                        </li>
                    @endif

                @endforeach
            </ul>
            <div id="button-wrapper">
                <a href="/vendor/opportunities/{{$opportunity->id}}/messages">
                    <button class="button"><i class="fa fa-comments" aria-hidden="true"></i> View Conversation</button>
                </a>
            </div>
        @else
            <p>
                Non assigned members cannot view internal messaging on this opportunity, assign yourself first.
            </p>
        @endif
    </div>
</div>


<div id="partner_consultation" class="block">
    <h3 class="title">Partner Consultation</h3>
    <div id="partner_consultation_wrapper">
        @if(!$opportunity->status->in_review)
            <p><i>Partner consultation will become available when this opportunity is in review.</i></p>
        @else
            @if(Auth::user()->isAssigned($opportunity->id))
                <div id="thread_wrapper">
                    @foreach($opportunity->threads as $thread)
                        <div class="thread">
                            <div class="thread_title">
                                <strong><p>{{ $thread->subject }}</p></strong>
                                <p>Started by: {{ $thread->creator->name() }}</p>
                            </div>
                            <div class="thread_latest">
                                {{ $thread->mostRecentMessage[0]->message }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="button-wrapper">
                    <a href="{{ route('vendor.opportunity.threads',$opportunity->id) }}">
                        <button class="button"><i class="fa fa-comments-o" aria-hidden="true"></i> View all threads</button>
                    </a>
                </div>
            @else
                <p>
                    Non assigned members cannot view partner consultation on this opportunity, assign yourself first.
                </p>
            @endif
        @endif
    </div>
</div>
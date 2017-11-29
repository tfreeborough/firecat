<div id="partner_consultation">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="title">Partner Consultation</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
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
            <a href="{{ route('vendor.opportunity.threads',$opportunity->id) }}">
                <button class="button"><i class="fa fa-comments-o" aria-hidden="true"></i> View all threads</button>
            </a>
        </div>
    </div>
</div>
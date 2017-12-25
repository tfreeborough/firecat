<div id="vendor_consultation" class="block">
    <h3 class="title">Vendor Consultation</h3>
    <div id="vendor_consultation_wrapper">
        <div id="thread_wrapper">
            @foreach($opportunity->threads as $thread)
                <div class="thread">
                    <div class="thread_title">
                        <strong><p>{{ $thread->subject }}</p></strong>
                        <p>Started by: {{ $thread->creator->name() }}</p>
                    </div>
                    <div class="thread_latest">
                        Most Recent Message | {{ $thread->mostRecentMessage[0]->message }}
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('partner.opportunity.threads',$opportunity->id) }}">
            <button class="button"><i class="fa fa-comments-o" aria-hidden="true"></i> View all threads</button>
        </a>
    </div>
</div>
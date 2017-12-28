@extends('app')

@section('title', $opportunity->name)

@section('content')
    <div id="opportunity_threads">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Threads - {{ $opportunity->name }}</h1>
            <h5 id="page-subtitle">All threads for {{ $opportunity->name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('partner.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('partner.opportunities')}}">
                            Opportunities
                        </a>
                    </li>
                    <li>
                        <a href="{{route('partner.opportunity',$opportunity->id)}}">
                            {{ $opportunity->name }}
                        </a>
                    </li>
                    <li>
                        Threads
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button class="button" onclick="createThread()">
                    <i class="fa fa-plus" aria-hidden="true"></i> Start a thread
                </button>
            </div>
        </div>
        <div id="opportunity_threads_wrapper">
            <div id="threads_menu">
                @foreach($opportunity->threads as $thread)
                    <div data-thread_id="{{$thread->id}}" class="thread_menu_item" onclick="setThread('{{ $thread->id }}')">
                        <p><strong>Subject: {{ $thread->subject }}</strong></p>
                        <p><small><img class="avatar default-avatar small" src="{{ $thread->creator->getAvatar() }}" />{{ $thread->creator->first_name }} {{ $thread->creator->last_name }}</small></p>
                        <div class="thread_menu_item_new_message">
                            <button class="button" onclick="newMessage('{{$thread->id}}')">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="threads_viewer">
                @foreach($opportunity->threads as $thread)
                    <div data-thread_id="{{$thread->id}}" class="thread_viewer_item hidden">
                        @foreach($thread->messages as $message)
                            <div class="thread_viewer_item_message">
                                <p>{{ $message->message }}</p>
                                <p class="extra">
                                    <small>
                                        <img class="avatar default-avatar small" src="{{ $thread->creator->getAvatar() }}" />
                                        {{ $thread->creator->first_name }} {{ $thread->creator->last_name }} <br />
                                        <span class="date">{{ \Carbon\Carbon::parse($message->created_at)->toDayDateTimeString() }}</span>
                                    </small>
                                </p>
                            </div>
                        @endforeach
                        @if(count($thread->messages) === 0)
                            <i><p>No messages have been sent to this thread yet, why not <span onclick="newMessage('{{$thread->id}}')" class="link">Add one</span></p></i>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function newMessage(id)
        {
            vex.dialog.open({
                message: 'Please write your message below',
                input: [
                    '<textarea name="message" rows="10" style="resize:none" placeholder="Message" required ></textarea>',
                ].join(''),
                buttons: [
                    $.extend({}, vex.dialog.buttons.YES, { text: 'Send' }),
                    $.extend({}, vex.dialog.buttons.NO, { text: 'Cancel' })
                ],
                callback: function (data) {
                    if (data) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{route('partner.opportunity.threads.message', $opportunity->id)}}',
                            type: 'POST',
                            data: {
                                message: data.message,
                                thread: id
                            },
                            success: function(result) {
                                $('#threads_viewer .thread_viewer_item').each(function(index, element){
                                    if($(element).data('thread_id') === id){
                                        $(element).children('i').remove();
                                        $(element).prepend('' +
                                                '<div class="thread_viewer_item_message animated fadeIn">' +
                                                '<p>'+Autolinker.link(data.message)+'</p>' +
                                                '<p>' +
                                                '<small>' +
                                                '<img class="avatar default-avatar small" src="{{ $thread->creator->getAvatar() }}" />' +
                                                '{{ $user->first_name }} {{ $user->last_name }}' +
                                                '</small>' +
                                                '</p>' +
                                                '</div>');
                                    }
                                });
                            }
                        });
                    }
                }
            })
        }


        function setThread(id)
        {
            $('#threads_viewer .thread_viewer_item').each(function(index, element){
                $('#threads_viewer .thread_viewer_item').addClass('hidden');
                if($(element).data('thread_id') === id){
                    $(element).removeClass('hidden').addClass('animated fadeIn');
                    $(element).children('.thread_viewer_item_message').each(function(index2, element2){
                        $(element2).html(Autolinker.link($(element2).html()));
                    });

                }
            });

            $('#threads_menu .thread_menu_item').each(function(index, element){
                $('#threads_menu .thread_menu_item').removeClass('active');
                if($(element).data('thread_id') === id){
                    $(element).addClass('active');
                }
            });
        }

        function createThread()
        {
            vex.dialog.prompt({
                message: 'Please give your Thread a subject line',
                placeholder: 'Subject line',
                callback: function (value) {
                    if(value.length > 0){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{route('vendor.opportunity.threads.create', $opportunity->id)}}',
                            type: 'POST',
                            data: {
                                subject: value
                            },
                            success: function(result) {
                                window.location.reload()
                            }
                        });
                    }
                }
            })
        }
    </script>
@endsection
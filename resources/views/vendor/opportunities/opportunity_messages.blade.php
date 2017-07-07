@extends('app')

@section('title', 'Opportunities')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Messages - {{ $opportunity->name }}</h1>
            <h5 id="page-subtitle">Total Messages: {{ count($opportunity->messages) }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vendor.opportunities')}}">
                            Opportunities
                        </a>
                    </li>
                    <li>
                        <a href="/vendor/opportunities/{{$opportunity->id}}">
                            {{ $opportunity->name }}
                        </a>
                    </li>
                    <li>
                        Messages
                    </li>
                </ul>
            </div>
        </div>
        <div id="vendor-opportunity-messages">
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12 col-sm-9" id="messages-container">
                        <div id="messages-container-list">
                            <ul>
                                @foreach($opportunity->getAllMessages() as $message)
                                    @if($message->isUser(Auth::user()->id))
                                        <li class="message me">
                                            <a name="{{$message->id}}">
                                                <div class="content">
                                                    {{ $message->message }}
                                                </div>
                                                <div class="info">
                                                    <ul>
                                                        <li><span style="background-color:{{$message->generateColorCode()}}" class="square"></span></li>
                                                        <li> | {{ \Carbon\Carbon::parse($message->created_at)->format('H:ia - j/m/Y') }}</li>
                                                    </ul>
                                                </div>
                                            </a>
                                        </li>
                                    @else
                                        <li class="message">
                                            <a name="{{$message->id}}">
                                                <div class="content">
                                                    {{ $message->message }}
                                                </div>
                                                <div class="info">
                                                    <ul>
                                                        <li><span style="background-color:{{$message->generateColorCode()}}" class="square"></span></li>
                                                        <li> | {{ \Carbon\Carbon::parse($message->created_at)->format('H:ia - j/m/Y') }}</li>
                                                    </ul>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                @if(count($opportunity->getAllMessages()) === 0)
                                    <li class="message">
                                        <div class="content">
                                            Nobody has posted a message yet, perhaps you could help out by being the first?
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div id="new-message">
                            <textarea id="new-message-textarea" placeholder="Enter your message here"></textarea>
                            <i onClick="submitMessage()" class="fa fa-paper-plane" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3" id="conversation-participants">
                        <h3>Participants</h3>
                        <div id="conversation-participants-key">
                            <ul>
                                @foreach($opportunity->getParticipants() as $participant)
                                    <li>
                                        <span style="background-color:{{ $participant->generateColorCode() }}" class="square"></span>
                                        <span class="participant">{{ $participant->user->first_name }} {{ $participant->user->last_name }}</span>
                                        <span class="avatar"><img src="{{ $participant->user->getAvatar() }}" /></span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a href="/vendor/opportunities/{{$opportunity->id}}"><button class="button">Back to Opportunity</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        if(window.location.hash) {
            $('.message').each(function(index, elem){
                var link = $(elem).find('a');
                if(('#'+link.attr('name')) === window.location.hash){
                    elem.scrollIntoView();
                    $(elem).addClass('highlighted animated flash');
                }
            });
        }

        $('.message .content').linkify();
        $('#new-message-textarea').focus();

        if(!window.location.hash){
            var element = document.getElementById("messages-container-list");
            element.scrollTop = element.scrollHeight;
        }

        function submitMessage(){
            var message = $('#new-message-textarea').val();

            console.log(message);

            if(message.length > 0){
                $.ajax({
                    type: "POST",
                    url: '/vendor/opportunities/{{ $opportunity->id }}/messages',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "message": message
                    },
                    success: function(response){
                        location.reload();
                    },
                }).fail(function(err){
                    vex.dialog.alert({
                        message: 'ERROR: '+err.statusText,
                        callback: function(){
                            $('#new-message-textarea').focus()
                        }
                    });
                });
            }else{
                vex.dialog.alert({
                    message: 'ERROR: You can\'t send an empty message',
                    callback: function(){
                        $('#new-message-textarea').focus()
                    }
                });
            }
        }

        $('#new-message-textarea').keypress(function(e){
            if(e.key === "Enter"){
                e.preventDefault();
                submitMessage();
            }
        });
    </script>
@endsection
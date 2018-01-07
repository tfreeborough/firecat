@extends('email.base')

@section('title', $thread_message->user->name().' sent you a message.')

@section('content')
    <style>
        #view_thread{
            margin-top:4rem;
            margin-bottom:4rem;
        }

        #thread_message{
            margin-top:4rem;
        }

        #thread_message h2{
            font-style: italic;
            margin-top:0;
        }

        #thread_message p{
            font-style: italic;
            margin-bottom:0;
        }
    </style>
    <div class="content">
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> you've been sent a message.</small></h1>
        <div>
            <p>
                {{ $thread_message->user->name() }} has sent a message to all members assigned to <strong>{{ $thread->opportunity->name }}</strong>.
                Please log in to your Firecat account to reply to the message, the full content of the message sent is shown below.
            </p>
            <div id="thread_message" class="block">
                <h2>{{ $thread->subject }}</h2>
                <p>
                    {{ $thread_message->message }}
                </p>
            </div>
            <div class="center">
                <p id="view_thread">
                    <a class="button" href="{{ route('vendor.opportunity.threads', $thread->opportunity->id) }}">View Message on Firecat</a>
                </p>
            </div>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ route('vendor.opportunity.threads', $thread->opportunity->id) }}
            </p>
            <p class="small">
                If you did not sign up to Firecat or believe you were sent this in error, please contact <span class="link">support@firecat.io</span> to let us know.
            </p>
        </div>
    </div>
@endsection

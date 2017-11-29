@extends('app')

@section('title', 'Add a user to '.$organisation->name)

@extends('_partials.authenticated.account_bar')
@extends('_partials.admin_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $organisation->name }} - Add User</h1>
            <h5 id="page-subtitle">Add a new user to {{ $organisation->name }}.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.onboarding')}}">
                            Onboarding
                        </a>
                    </li>
                    <li>
                        <a href="/admin/onboarding/{{$organisation->id}}">
                            {{ $organisation->name }}
                        </a>
                    </li>
                    <li>Add User</li>
                </ul>
            </div>
        </div>
        <div id="organisation-add-user">
            @include('_partials.flash_message')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <h3>Invite a new user</h3>
                    {!! Form::open(['url' => '/admin/onboarding/'.$organisation->id.'/add/new']) !!}
                    <div class="form-group">
                        {{ Form::label('first_name', null, ['class' => 'control-label']) }}
                        {{ Form::text('first_name', null, array_merge(['class' => 'form-control','autocomplete' => 'off'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('last_name', null, ['class' => 'control-label']) }}
                        {{ Form::text('last_name', null, array_merge(['class' => 'form-control','autocomplete' => 'off'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', null, ['class' => 'control-label']) }}
                        {{ Form::text('email', null, array_merge(['class' => 'form-control','autocomplete' => 'off'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('admin', null, ['class' => 'control-label']) }}
                        {{ Form::checkbox('admin', null, false, null) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Invite user to organisation', array_merge(['class' => 'button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <h3>...Or search for a user below.</h3>
                    {{ Form::label('email', null, ['class' => 'control-label']) }}
                    {{ Form::text('email', null, array_merge([
                    'class' => 'form-control',
                    'id' => 'email-search',
                    'autocorrect' => 'off',
                    'autocomplete' => 'off'
                    ])) }}

                    <div id="user-search-box">
                        {!! Form::open(['url' => '/admin/onboarding/'.$organisation->id.'/add/link']) !!}
                        <div class="form-group">
                            {{ Form::label('email', null, ['class' => 'control-label']) }}
                            {{ Form::select('email', [], null, ['class' => 'form-control', 'id' => 'user-search','autocomplete' => 'off']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Link user', array_merge(['class' => 'button'])) }}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var users = {!! $json_users !!};
        var options = {
            shouldSort: true,
            threshold: 0.6,
            location: 0,
            distance: 100,
            maxPatternLength: 32,
            minMatchCharLength: 1,
            keys: [
                "email",
                "first_name",
                "last_name"
            ]
        };

        $(function(){

            var fuse = new Fuse(users, options);

            $('#email-search').keyup(function(e) {
                var result = fuse.search(e.target.value);
                console.log(result);
                var options = $('#user-search').empty();
                console.log(options);
                $.each(result, function( index, value){
                    options.append($("<option />").val(value.email).text(value.first_name+' '+value.last_name+' ('+value.email+')'));
                });
            });
        });
    </script>
@endsection
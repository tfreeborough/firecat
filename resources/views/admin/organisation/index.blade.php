@extends('app')

@section('title', $organisation->name)

@extends('_partials.authenticated.account_bar')
@extends('_partials.admin_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $organisation->name }}</h1>
            <h5 id="page-subtitle">View, Edit and Update {{ $organisation->name }} and it's users.</h5>
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

                    <li>{{ $organisation->name }}</li>
                </ul>
            </div>
        </div>
        <div id="organisation">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-xs-12">
                        <div id="login-errors" class="text-left">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12">
                    <a href="/admin/onboarding/{{ $organisation->id }}/add">
                        <button class="button action">Add user to {{ $organisation->name }}</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organisation->members as $member)
                            <tr>
                                <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>
                                    <button
                                            class="btn btn-danger"
                                            title="Remove this user from {{ $organisation->name }}"
                                            onClick="confirmUnlink('{{ $member->first_name.' '.$member->last_name }}', '{{ $member->id }}')"
                                    ><i class="fa fa-chain-broken" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function confirmUnlink(member, member_id)
        {
            vex.dialog.confirm({
                message: 'Are you absolutely sure you want to unlink '+member+' from {{ $organisation->name }}?',
                callback: function (value) {
                    if (value) {
                        window.location.href = '/admin/onboarding/{{ $organisation->id }}/unlink/'+member_id;
                    }
                }
            })
        }
    </script>
@endsection
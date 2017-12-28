@extends('app')

@section('title', $organisation->name)

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
                    <li>
                        <a href="{{route('admin.onboarding.index', $organisation->id)}}">
                            {{ $organisation->name }}
                        </a>
                    </li>
                    <li>Invites</li>
                </ul>
            </div>
        </div>
        <div id="organisation-invites">
            @include('_partials.flash_message')
            <div class="row">
                <div class="col-xs-12">
                    <a href="/admin/onboarding/{{ $organisation->id }}">
                        <button class="button">View Users</button>
                    </a>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    @include('admin.organisation.onboarding.pending_invites')
                </div>
                <div class="col-xs-12 col-md-6">
                    @include('admin.organisation.onboarding.invite_user')
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#organisation_invites_table').DataTable();

        function confirmRenewInvite(invite_id)
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to renew this invite?',
                callback: function (value) {
                    if (value) {
                        window.location.href = "/admin/onboarding/{{$organisation->id}}/renew_invite/"+invite_id;
                    }
                }
            })
        }

        function confirmDeleteInvite(invite_id)
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to delete this invite?',
                callback: function (value) {
                    if (value) {
                        window.location.href = "/admin/onboarding/{{$organisation->id}}/delete_invite/"+invite_id;
                    }
                }
            })
        }

    </script>
@endsection
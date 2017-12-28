@extends('app')

@section('title', 'Organisation Administration')

@section('content')
    <div id="page-topper">
        <div id="page-topper-bg"></div>
        <h1 id="page-title">Administration</h1>
        <h5 id="page-subtitle">Administration for {{ $vendor->name }}</h5>
        <div id="page-topper-breadcrumbs">
            <ul>
                <li>
                    <a href="{{route('vendor.dashboard')}}">
                        Dashboard
                    </a>
                </li>
                <li>
                    Administration
                </li>
            </ul>
        </div>
    </div>
    @include('_partials.flash_message')
    <div id="vendor-admin-onboarding">
        <div id="vendor-admin-pending-invites">
            <h3 class="title">Pending Invites</h3>
            @include('vendor.admin.onboarding.pending_invites')
        </div>
        <div id="vendor-admin-invite-user">
            <h3 class="title">Invite a new user</h3>
            @include('vendor.admin.onboarding.invite_user')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#vendor-pending-invites-table').DataTable();

        function confirmRenewInvite(invite_id)
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to renew this invite?',
                callback: function (value) {
                    if (value) {
                        window.location.href = "/vendor/administration/onboarding/{{$vendor->id}}/renew_invite/"+invite_id;
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
                        window.location.href = "/vendor/administration/onboarding/{{$vendor->id}}/delete_invite/"+invite_id;
                    }
                }
            })
        }
    </script>
@endsection
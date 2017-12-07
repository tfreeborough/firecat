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
            @include('_partials.flash_message')
            <div class="row">
                <div class="col-xs-12">
                    <a href="/admin/onboarding/{{ $organisation->id }}/add">
                        <button class="button action">Add user to {{ $organisation->name }}</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table id="organisation_user_table" class="table">
                        <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Email</th>
                            <th>Account Type</th>
                            <th>Assignments</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organisation->members as $member)

                            <tr>
                                <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>
                                    @if($member->isVendorAdministrator($organisation->id))
                                        Administrator
                                    @else
                                        User
                                    @endif
                                </td>
                                <td>
                                    {{ count($member->assignments) }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($member->last_login)->diffForHumans() }}
                                </td>
                                <td>
                                    <button
                                            class="button"
                                            title="Remove this user from {{ $organisation->name }}"
                                            onClick="confirmUnlink('{{ $member->first_name.' '.$member->last_name }}', '{{ $member->id }}')"
                                    ><i class="fa fa-chain-broken" aria-hidden="true"></i></button>
                                    @if(!$member->isVendorAdministrator($organisation->id))
                                        <button
                                                class="button"
                                                title="Make this user an admin of {{ $organisation->name }}"
                                                onClick="confirmAdmin('{{ $member->first_name.' '.$member->last_name }}', '{{ $member->id }}')"
                                        ><i class="fa fa-superpowers" aria-hidden="true"></i></button>
                                    @else
                                        <button
                                                class="button"
                                                title="Demote {{ $member->name() }} to a regular user."
                                                onClick="confirmDeAdmin('{{ $member->first_name.' '.$member->last_name }}', '{{ $member->id }}')"
                                        ><i class="fa fa-user-times" aria-hidden="true"></i></button>
                                    @endif
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
        $('#organisation_user_table').DataTable();


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

        function confirmAdmin(member, member_id)
        {
            vex.dialog.confirm({
                message: 'Are you want to make '+member+' an admin of {{ $organisation->name }}?',
                callback: function (value) {
                    if (value) {
                        window.location.href = '/admin/onboarding/{{ $organisation->id }}/adminify/'+member_id;
                    }
                }
            })
        }

        function confirmDeAdmin(member, member_id)
        {
            vex.dialog.confirm({
                message: 'Are you demote '+member+' to being a regular user of {{ $organisation->name }}?',
                callback: function (value) {
                    if (value) {
                        window.location.href = '/admin/onboarding/{{ $organisation->id }}/deadminify/'+member_id;
                    }
                }
            })
        }
    </script>
@endsection
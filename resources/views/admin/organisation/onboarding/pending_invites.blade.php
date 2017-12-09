<h3 class="title">Pending Invites</h3>
<table id="organisation_invites_table" class="table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Invited</th>
        <th>Valid</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($organisation->invites as $invite)
        <tr>
            <td>{{ $invite->first_name }} {{ $invite->last_name }}</td>
            <td>{{ $invite->email }}</td>
            <td>{{ \Carbon\Carbon::parse($invite->created_at)->toDayDateTimeString() }}</td>
            @if($invite->withinExpiry())
                <td><i class="fa fa-check green" aria-hidden="true"></i></td>
            @else
                <td><i class="fa fa-times red" aria-hidden="true"></i></td>
            @endif
            @if($invite->withinExpiry())
                <td><i onClick="confirmDeleteInvite('{{$invite->id}}')" title="Remove Invite" class="fa fa-user-times" aria-hidden="true"></i></td>
            @else
                <td><i onClick="confirmDeleteInvite('{{$invite->id}}')" title="Remove Invite" class="fa fa-user-times" aria-hidden="true"></i></td>
                <td><i onClick="confirmRenewInvite('{{$invite->id}}')" title="Resend Invite" class="fa fa-refresh" aria-hidden="true"></i></td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
<a href="/admin/onboarding/{{ $organisation->id }}/add">
    <button class="button action">Add user to {{ $organisation->name }}</button>
</a>
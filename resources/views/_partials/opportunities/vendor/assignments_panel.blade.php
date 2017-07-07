<h3 class="title">Assignments</h3>
<div class="row">
    <div class="col-xs-12">
        <p>Any members of {{ $user->organisation->name }} that are assigned to this opportunity will show here when they are made.</p>
    </div>
    @foreach($opportunity->assignees as $assignee)
        <div class="assignment-block col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <img src={{ $assignee->user->extra->avatar_url }} />
            <p>{{ $assignee->user->first_name }} {{ $assignee->user->last_name }}</p>
        </div>
    @endforeach
    @if(count($opportunity->assignees) === 0)
        <div class="col-xs-12">
            <p><strong>Nobody is currently assigned to this opportunity</strong></p>
        </div>
    @endif
</div>
@if(!$user->isAssigned($opportunity->id))
    <button onClick="assignmentConfirm()" class="button action">Assign me to this opportunity</button>
@endif
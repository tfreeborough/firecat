<div id="assignments_panel" class="block">
    <h3 class="title">Assignments</h3>
    <div id="assignments_panel_wrapper">
        <p>Any members of {{ $user->organisation->name }} that are assigned to this opportunity will show here when they are made.</p>
        <div id="assignments_panel_avatars">
            @foreach($opportunity->assignees as $assignee)
                <div class="assignment-block">
                    <img src={{ $assignee->user->extra->avatar_url }} />
                    <p>{{ $assignee->user->first_name }} {{ $assignee->user->last_name }}</p>
                </div>
            @endforeach
        </div>
        @if(count($opportunity->assignees) === 0)
            <div>
                <p><strong>Nobody is currently assigned to this opportunity</strong></p>
            </div>
        @endif
        @if(!$user->isAssigned($opportunity->id))
            <button onClick="assignmentConfirm()" class="button action">Assign me to this opportunity</button>
        @endif
    </div>
</div>

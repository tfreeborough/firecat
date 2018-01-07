<div id="assignments_panel" class="block">
    <h3 class="title">Assignments</h3>
    <div id="assignments_panel_wrapper">
        <p>Any members of {{ $user->organisation->name }} that are assigned to this opportunity will show here when they are made.</p>
        <div id="assignments_panel_avatars">
            @foreach($opportunity->assignees as $assignee)
                <div class="assignment-block">
                    <img src="{{ $assignee->user->getAvatar() }}" />
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
            <div id="assignments_panel_wrapper_assign">
                <button onClick="assignmentConfirm()" class="button action">Assign me to this opportunity</button>
            </div>
        @endif
    </div>
</div>
<script>
    function assignmentConfirm()
    {
        vex.dialog.confirm({
            message: 'Are you sure you want to assign youself to this opportunity, you will not be able to undo this action?',
            callback: function (value) {
                if (value) {
                    window.location.href = '/vendor/opportunities/{{$opportunity->id}}/assign';
                }
            }
        })
    }
</script>

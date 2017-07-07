<div class="status-code-display">
    <table>
        <thead>
            <tr>
                <th>Associated</th>
                <th>In Review</th>
                <th>Accepted</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @if($opportunity->status->getStatusCode() < 1)
                        <div class="grey">
                            <i class="fa fa-question" aria-hidden="true"></i>
                        </div>
                    @else
                        <div class="good">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                    @endif
                </td>
                <td>
                    @if($opportunity->status->getStatusCode() < 2)
                        <div class="grey">
                            <i class="fa fa-question" aria-hidden="true"></i>
                            @if(Auth::user()->isVendor() && Auth::user()->isAssigned($opportunity->id))
                                <div>
                                    <small><button class="button action" onClick="reviewConfirm()">Review this opportunity</button></small>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="good">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                    @endif
                </td>
                <td>
                    @if($opportunity->status->getStatusCode() < 4)
                        <div class="grey">
                            <i class="fa fa-question" aria-hidden="true"></i>
                        </div>
                    @elseif($opportunity->status->getStatusCode() === 4)
                        <div class="good">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                    @elseif($opportunity->status->getStatusCode() === 5)
                        <div class="bad">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <a class="pull-right" href="{{ route('docs.opportunities.statuses') }}">
        <small>Learn more about statuses</small>
    </a>
</div>
<script>
    function reviewConfirm()
    {
        vex.dialog.confirm({
            message: 'Are you sure you want to review this opportunity? Reviewing will allow you to message the partner and ask for clarification on any further details before you approve/deny the ' +
            'opportunity, the partner will see your and any other associated vendor accounts once this opportunity goes into review.',
            callback: function (value) {
                if (value) {
                    window.location.href = '/vendor/opportunities/{{$opportunity->id}}/review';
                }
            }
        })
    }
</script>
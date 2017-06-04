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
<div id="opportunity_information">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="title">Opportunity Information</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            @if($opportunity->reference !== null)
                <p><strong>Reference:</strong> {{ $opportunity->reference }}</p>
            @endif
            <p><strong>Purchase Type:</strong> {{ $opportunity->purchase_type }}</p>
            <p><strong>Type of Procurement:</strong> {{ $opportunity->procurement_type }}</p>
            @if($opportunity->competitors !== null)
                <p><strong>Competitors:</strong> {{ $opportunity->competitors }}</p>
            @endif
        </div>
        <div class="col-xs-12 col-md-6">
            @if($opportunity->date_of_award !== null)
                <p><strong>Date of Award:</strong> {{ \Carbon\Carbon::parse($opportunity->date_of_award)->toFormattedDateString() }}</p>
            @endif
            <p><strong>Implementation Date:</strong> {{ \Carbon\Carbon::parse($opportunity->implementation)->toFormattedDateString() }}</p>
            <p><strong>Direct/Indirect Procurement:</strong> {{ $opportunity->direct_indirect_procurement }}</p>
        </div>
        <div class="col-xs-12">
            <table id="opportunity-value-table" class="table">
                <thead>
                <tr>
                    <th>Estimated Value</th>
                    <th>Estimated Units</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>&pound;{{ number_format($opportunity->estimated_value/100,2) }}</td>
                    <td>{{ number_format($opportunity->estimated_units,0) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12">
            <p><strong>Justification:</strong></p>
            <p>
                {{ $opportunity->justification }}
            </p>
        </div>
    </div>
</div>


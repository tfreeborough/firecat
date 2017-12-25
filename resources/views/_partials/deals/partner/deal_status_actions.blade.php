<div id="deal_status_actions" class="block">
    <div>
        <ul>
            <li title="Mark deal as Won" onClick="confirmWon()">
                <i class="fa fa-trophy" aria-hidden="true"></i>
            </li>
            <li title="Request to modify the implementation date of this deal" onClick="requestImplementationDateChange()">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </li>
            <li title="Mark deal as Lost" onClick="confirmLost()">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            </li>
        </ul>
    </div>
</div>
<script>
    function confirmWon(){
        vex.dialog.confirm({
            message: 'Are you sure you want to mark this deal as won?',
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, { text: 'Yes' }),
                $.extend({}, vex.dialog.buttons.NO, { text: 'No' })
            ],
            callback: function (value) {
                if(value){
                    window.location.href = '{{ route('partner.deal.won', $deal->id) }}';
                }
            }
        })
    }

    function confirmLost(){
        vex.dialog.confirm({
            message: 'Are you sure you want to mark this deal as lost?',
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, { text: 'Yes' }),
                $.extend({}, vex.dialog.buttons.NO, { text: 'No' })
            ],
            callback: function (value) {
                if(value){
                    window.location.href = '{{ route('partner.deal.lost', $deal->id) }}';
                }
            }
        })
    }

    function requestImplementationDateChange(){

        setTimeout(function(){
            $('[data-toggle="datepicker"]').datepicker({
                autoShow: true,
                format: 'dd/mm/yyyy',
                startDate: new Date()
            });
        },500);

        vex.dialog.open({
            message: 'Pick a new implementation date:',
            input: [
                '<p><small><strong>Note: Your new Implementation date can be rejected by the Vendor.</strong></small></p>',
                '<input name="implementation_date" data-toggle="datepicker" type="text" placeholder="dd/mm/yyyy" required />',
                '<input name="type" type="hidden" value="implementation_date" />',
                '<input name="formatted_type" type="hidden" value="Implementation Date" />',
            ].join(''),
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, { text: 'Submit' }),
                $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
            ],
            callback: function (data) {
                if (data) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('partner.deal.implementation_change_request', $deal->id)}}',
                        type: 'POST',
                        data: {
                           implementation_date: data.implementation_date,
                           type: data.type,
                           formatted_type: data.formatted_type,
                        },
                        success: function(result) {
                            window.location.reload();
                        },
                        error: function(error) {
                            console.log(error.responseJSON);
                        }
                    });
                }
            }
        });
    }
</script>
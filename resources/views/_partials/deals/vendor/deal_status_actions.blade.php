<div id="deal_status_actions" class="block">
    <div>
        <ul>
            <li title="Mark deal as Won" onClick="confirmWon()">
                <i class="fa fa-trophy" aria-hidden="true"></i>
            </li>
            <li title="Request an update on this deal" onClick="confirmRequestDealUpdate()">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
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
                    window.location.href = '{{ route('vendor.deal.won', $deal->id) }}';
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
                    window.location.href = '{{ route('vendor.deal.lost', $deal->id) }}';
                }
            }
        })
    }

    function confirmRequestDealUpdate(){
        vex.dialog.confirm({
            message: 'Are you sure you\'d like to request an update from the partner on the status of this deal? ',
            buttons: [
                $.extend({}, vex.dialog.buttons.YES, { text: 'Yes' }),
                $.extend({}, vex.dialog.buttons.NO, { text: 'No' })
            ],
            callback: function (value) {
                if(value){
                    window.location.href = '{{ route('vendor.deal.request_update', $deal->id) }}';
                }
            }
        })
    }
</script>
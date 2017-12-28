<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/12/2017
 * Time: 16:31
 */

namespace App\Mail\partner;


use App\Models\Deal;
use App\Models\DealUpdate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorRejectedDealUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $deal;
    public $dealUpdate;

    /**
     * Create a new message instance.
     *
     * @param Deal $deal
     * @param User $user
     * @param DealUpdate $dealUpdate
     */
    public function __construct(Deal $deal, User $user, DealUpdate $dealUpdate)
    {
        $this->deal = $deal;
        $this->user = $user;
        $this->dealUpdate = $dealUpdate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->deal->opportunity->organisation->name.' has rejected your proposed change.')
            ->from('no-reply@firecat.io')
            ->view('email.partner.proposed_change_rejected');
    }
}
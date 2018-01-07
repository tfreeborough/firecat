<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/12/2017
 * Time: 16:31
 */

namespace App\Mail\vendor;


use App\Models\Deal;
use App\Models\DealUpdate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartnerProposedDealUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $deal;
    public $deal_update;

    /**
     * Create a new message instance.
     *
     * @param Deal $deal
     * @param User $user
     * @param DealUpdate $deal_update
     */
    public function __construct(Deal $deal, User $user, DealUpdate $deal_update)
    {
        $this->deal = $deal;
        $this->user = $user;
        $this->deal_update = $deal_update;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->deal->opportunity->name.' has a new update.')
            ->from('no-reply@firecat.io')
            ->view('email.vendor.proposed_deal_update');
    }
}
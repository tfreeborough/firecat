<?php

namespace App\Mail\partner;


use App\Models\Deal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartnerTriggerDealLost_PARTNER extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $deal;

    /**
     * Create a new message instance.
     *
     * @param Deal $deal
     * @param User $user
     */
    public function __construct(Deal $deal, User $user)
    {
        $this->deal = $deal;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('You recently marked a deal as lost.')
            ->from('no-reply@firecat.io')
            ->view('email.partner.PARTNER_TRIGGER_deal_lost');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/12/2017
 * Time: 16:31
 */

namespace App\Mail\partner;


use App\Models\Deal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorTriggerDealLost_PARTNER extends Mailable
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
            ->subject($this->deal->opportunity->name.' has been LOST.')
            ->from('no-reply@firecat.io')
            ->view('email.partner.VENDOR_TRIGGER_deal_lost');
    }
}
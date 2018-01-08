<?php

namespace App\Mail\partner;


use App\Models\Deal;
use App\Models\DealUpdate;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorRejectedOpportunity_PARTNER extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $opportunity;

    /**
     * Create a new message instance.
     *
     * @param Opportunity $opportunity
     * @param User $user
     */
    public function __construct(Opportunity $opportunity, User $user)
    {
        $this->opportunity = $opportunity;
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
            ->subject($this->opportunity->organisation->name.' has rejected your opportunity.')
            ->from('no-reply@firecat.io')
            ->view('email.partner.vendor_rejected_opportunity');
    }
}
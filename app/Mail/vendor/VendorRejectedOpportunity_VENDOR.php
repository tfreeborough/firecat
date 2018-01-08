<?php

namespace App\Mail\vendor;


use App\Models\Deal;
use App\Models\DealUpdate;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorRejectedOpportunity_VENDOR extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $opportunity;
    public $rejector;

    /**
     * Create a new message instance.
     *
     * @param Opportunity $opportunity
     * @param User $user
     * @param User $rejector
     */
    public function __construct(Opportunity $opportunity, User $user, User $rejector)
    {
        $this->opportunity = $opportunity;
        $this->user = $user;
        $this->rejector = $rejector;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->opportunity->name.' was rejected by a team member.')
            ->from('no-reply@firecat.io')
            ->view('email.vendor.vendor_rejected_opportunity');
    }
}
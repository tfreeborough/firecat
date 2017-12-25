<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/12/2017
 * Time: 16:31
 */

namespace App\Mail;


use App\Models\Deal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestDealUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $deal;
    public $vendor_account;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Deal $deal
     * @param User $vendor_account
     */
    public function __construct(User $user, Deal $deal, Authenticatable $vendor_account)
    {
        $this->user = $user;
        $this->deal = $deal;
        $this->vendor_account = $vendor_account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->vendor_account->name().' ('.$this->vendor_account->organisation->name.') has requested an update on a deal')
            ->from('no-reply@firecat.io')
            ->view('email.request_deal_update');
    }
}
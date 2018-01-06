<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 23/12/2017
 * Time: 16:31
 */

namespace App\Mail\vendor;

use App\Models\DealUpdate;
use App\Models\OpportunityThread;
use App\Models\OpportunityThreadMessage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartnerSentThreadMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $thread_message;
    public $organisation;
    public $thread;

    /**
     * Create a new message instance.
     *
     * @param OpportunityThreadMessage $message
     * @param User $user
     */
    public function __construct(OpportunityThreadMessage $message, User $user)
    {
        $this->thread = $message->opportunity_thread;
        $this->organisation = $message->opportunity_thread->opportunity->organisation;
        $this->thread_message = $message;
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
            ->subject($this->thread_message->user->name().' sent you a message.')
            ->from('no-reply@firecat.io')
            ->view('email.vendor.partner_sent_thread_message');
    }
}
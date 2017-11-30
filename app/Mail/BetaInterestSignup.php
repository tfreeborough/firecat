<?php

namespace App\Mail;

use App\Models\BetaInterest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BetaInterestSignup extends Mailable
{
    use Queueable, SerializesModels;

    public $betaInterest;

    /**
     * Create a new message instance.
     *
     * @param BetaInterest $betaInterest
     */
    public function __construct(BetaInterest $betaInterest)
    {
        $this->betaInterest = $betaInterest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Beta Interest Signup')->from('no-reply@firecat.io')->view('email.BetaInterestSignup');
    }
}

<?php

namespace App\Mail;

use App\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Otp $otp){

        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
                    ->view('send_email_user_registered')
                    ->with([
                        'otp_code' => $this->otp->otp_code,
                        'valid_until' => $this->otp->valid_until,
                        'name' => $this->otp->get_user_data->name
                        ]);

    }
}

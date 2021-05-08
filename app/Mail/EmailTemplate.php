<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Email;

class EmailTemplate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    private $emailMessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->emailMessage = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->emailMessage->sent = 1;
        $this->emailMessage->save();
        return $this->to($this->emailMessage->email_address)
            ->from('mail@example.com', 'Mailtrap')
            ->subject('Email App')
            ->markdown('emails.email')
            ->with([
                'email' => $this->emailMessage
            ])->attach($this->emailMessage->attachment);
    }


}

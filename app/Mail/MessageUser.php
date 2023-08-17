<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageUser extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $message, $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $subject, $message)
    {
        $this->user = $user;
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@cesdan.com')
            ->subject($this->subject." - ".config('app.name'))
            ->markdown('mails.user.message-user');

    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AuthMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $token;

    public function __construct(User $user,string $token)
    {
        $this -> user = $user;
        $this -> token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('メール認証のご案内')
                    ->view('authmail')
                    ->with(['email' => $this->user->email,
                            'name' => $this->user->name,
                            'verifyUrl' => route('auth.verify', ['token' => $this->token])]);
    }
}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ResetPasswordLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user,$token;

    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.reset-password');
        return $this->markdown('emails.reset-password')
                    ->subject('Cambiar contraseña')
                    ->attach(public_path('/img').'/_surmodel_og.jpg', [
                        'as' => 'logo.jpg',
                        'mime' => 'image/jpeg',
        ]);
    }
}

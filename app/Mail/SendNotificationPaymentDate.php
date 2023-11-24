<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Event\Publication;
use App\Models\User\Person;

class SendNotificationPaymentDate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $person;
    public $publication;
    public $image;

    public function __construct(Person $person, Publication $publication)
    {
        $this->person  = $person;
        $this->publication  = $publication;
        // if($publication->evento->path_image){
        //     $this->image = $publication->evento->path_image;
        // }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin.events.notificationPaymentDate')
                    ->subject('Surmodel Fecha de pago evento '.$this->publication->event->name)
                    ->attach(public_path('/img').'/_surmodel_og.jpg', [
                    'as' => 'logo.jpg',
                    'mime' => 'image/jpeg',
        ]);
    }
}

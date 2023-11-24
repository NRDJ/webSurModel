<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Event\Publication;
use App\Models\User\Person;
use App\Models\Payment\Payment;


class SendVoucherMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $payment;
    public $person;
    public $publication;

    public function __construct( Person $person, Publication $publication, Payment $payment )
    {
        $this->person  = $person;
        $this->publication  = $publication;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path_file =  $this->publication->id."/".$this->person->user->id."/".$this->payment->transfer_voucher;
        $storagePath = storage_path('app/vouchers/' . $path_file);

        return $this->markdown('emails.admin.events.sendVoucherMail')
                    ->subject('Comprobante de pago de evento '.$this->publication->event->name)
                    ->attach($storagePath);
    }
}

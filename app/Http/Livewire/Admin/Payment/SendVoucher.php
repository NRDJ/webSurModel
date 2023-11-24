<?php

namespace App\Http\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\Event\Publication;
use App\Models\User\Person;
use App\Models\User\PersonRequest;
use App\Models\Payment\Payment;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Mail\SendVoucherMail;
use Illuminate\Support\Facades\Mail;

class SendVoucher extends Component
{
    use LivewireAlert;
    
    public $payment,$publication,$person;

    public function mount(Payment $payment, Publication $publication, Person $person){
        $this->payment = $payment;
        $this->publication = $publication;
        $this->person = $person;
    }


    public function render()
    {
        return view('livewire.admin.payment.send-voucher');
    }

    public function sendMailVoucher(){

        // dd($this->person->user->email);
        Mail::to($this->person->user->email)->send(new SendVoucherMail($this->person,$this->publication,$this->payment));

        $this->alert('success', 'comprobante enviado exitosamente!!', [
            'position' =>  'center', 
            'timer' =>  3000,  
            'toast' =>  false,
        ]);
    }
}

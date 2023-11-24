<?php

namespace App\Http\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\Event\Publication;
use App\Models\User\Person;
use App\Models\User\PersonRequest;
use App\Models\Payment\Payment;
use App\Models\User;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use File;

class UploadVoucher extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    
    public $payment,$publication,$person,$identificador,$voucher;

    public function mount(Payment $payment, Publication $publication, Person $person){
        $this->payment = $payment;
        $this->publication = $publication;
        $this->person = $person;
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.admin.payment.upload-voucher');
    }

    public function upload(){
        
        $validateData = $this->validate([
            'voucher' => ['required','mimes:jpeg,jpg,png,pdf'],
        ],
        [
            // 'voucher.mimes' => 'Formato de archivo incorrecto!',
            'voucher.required' => 'Debe subir un archivo',
            'voucher.mimes' => 'Archivo con formato no compatible',
        ]);

        $this->voucher->store('vouchers/'.$this->publication->id.'/'.$this->person->user->id);

        $path_file = $this->voucher->hashname();
    
        $this->payment->update([
            'transfer_voucher' => $path_file,
        ]);
        
        $this->identificador = rand();

        $this->emit('render');

        $this->alert('success', 'comprobante subido exitosamente!!', [
            'position' =>  'center', 
            'timer' =>  3000,  
            'toast' =>  false,
        ]);

    }

    public function delete(){

        $path_file = $this->publication->id.'/'.$this->person->id.'/'.$this->payment->transfer_voucher;

        $storagePath = storage_path('app/vouchers/' . $path_file);
        if(File::exists($storagePath)) {
            File::delete($storagePath);
        }

        $this->payment->update([
            'transfer_voucher' => null,
        ]);

        $this->identificador = rand();

        $this->emit('render');
        $this->alert('success', 'comprobante eliminado exitosamente!!', [
            'position' =>  'center', 
            'timer' =>  3000,  
            'toast' =>  false,
        ]);
    }
}


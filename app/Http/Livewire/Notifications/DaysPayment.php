<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Models\Event\Publication;
use App\Models\User\Person;
use App\Models\User\PersonRequest;
use App\Models\Payment\Payment;
use App\Models\User;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DaysPayment extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    
    public $publication,$person,$identificador,$confirmation,$file;

    public function mount(Publication $publication,User $user){
        $this->publication = $publication;
        $this->person = $user->person;
        $this->publication = $publication;
        $this->identificador = rand();
        $this->confirmation = "No";
    }

    public function render()
    {
        return view('livewire.notifications.days-payment');
    }

    public function send(){
        
        $pr= PersonRequest::where('person_id',$this->person->id)->where('publication_id',$this->publication->id)->first();
        $payment = Payment::where('person_request_id',$pr->id)->first();

        if($payment){
            $this->alert('error', 'Ya se ha enviado una boleta!!', [
                'position' =>  'center', 
                'timer' =>  3000,  
                'toast' =>  false,
            ]);
        }
        else{
            $validateData = $this->validate([
                'file' => ['required','mimes:jpeg,jpg,png,pdf'],
            ],
            [
                // 'file.mimes' => 'Formato de archivo incorrecto!',
                'file.required' => 'Tienes que subir un archivo!',
            ]);
            
            $pay_day = ($this->confirmation == "No") ? \Carbon\Carbon::parse($this->publication->event->end_date)->addDays(40) : \Carbon\Carbon::parse($this->publication->event->end_date); 
    
            $this->file->store('invoices/'.$this->publication->id.'/'.$this->person->user->id);
            $path_file = $this->file->hashname();
    
            Payment::create([
                'pay_day' => $pay_day,
                'person_request_id' => $pr->id,
                'discount' => $this->confirmation,
                'honorary_ticket' => $path_file,
            ]); 
    
            $this->alert('success', 'Boleta enviada!!', [
                'position' =>  'center', 
                'timer' =>  3000,  
                'toast' =>  false,
            ]);

            return redirect()->to(asset('/dashboard/applications'));
        }

        
    }
}

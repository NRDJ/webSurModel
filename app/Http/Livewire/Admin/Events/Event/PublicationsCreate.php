<?php

namespace App\Http\Livewire\Admin\Events\Event;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\User\Profile;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class PublicationsCreate extends Component
{
    use LivewireAlert;

    public $remuneration,$amount,$collation,$state,$date,$start_time,$time_end,$event_id,$profile_id;  
    public $event;
    
    public function mount (Event $event){
        $this->event = Event::find($event->id);
    }

    public function render()
    {
        // $profiles = Profile::all()->sortByAsc('name');
        $profiles = Profile::all();

        return view('livewire.admin.events.event.publications-create',[
            'profiles'=>$profiles
        ]);
    }

    public function save(){
        
        $validateData = $this->validate([
            'remuneration' => ['required','numeric','min:1','not_in:0'],
            'amount' => ['required','numeric','min:1','not_in:0'],
            'collation' => ['required'],
            'state' => ['required'],
            'profile_id' => ['required'],
        ],        
        [
            'remuneration.required' => "El campo es requerido",
            'remuneration.numeric' => "El campo debe ser numerico",
            'remuneration.min' => "El campo debe ser minimo 1",
            'remuneration.not_in' => "El campo no puede ser 0",
            'amount.required' => "El campo es requerido",
            'amount.numeric' => "El campo debe ser numerico",
            'amount.min' => "El campo debe ser minimo 1",
            'amount.not_in' => "El campo no puede ser 0",
            'collation.required' => "El campo es requerido",
            'state.required' => "El campo es requerido",
            'profile_id.required' => "El campo es requerido",
        ]);

        Publication::create([
            'remuneration' => $this->remuneration,
            'amount' => $this->amount,
            'collation' => $this->collation,
            'state' => $this->state,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'time_end' => $this->time_end,
            'event_id' => $this->event->id,
            'profile_id' => $this->profile_id,
        ]); 

        $this->alert('success', 'Publicación Creada!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);
        

        $this->reset('remuneration','amount','collation','state','date','start_time','time_end','profile_id');
        $this->emitTo('admin.events.event.publications-list', 'render');

    }
}

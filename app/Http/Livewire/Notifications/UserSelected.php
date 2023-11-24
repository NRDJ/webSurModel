<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Models\Event\Publication;
use App\Models\User\Person;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserSelected extends Component
{
    use LivewireAlert;
    public $publication,$person;

    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
    ];

    public function mount(Publication $publication,User $user){
        $this->publication = $publication;
        $this->person = $user->person;
    }

    public function render()
    {
        return view('livewire.notifications.user-selected');
    }

    public function approve(){

        if ($this->person->person_request()->where('publication_id',$this->publication->id)->first()->pivot->state == "Seleccionado") {
            
            $this->person->person_request()->updateExistingPivot($this->publication->id,['state'=>'Confirmado'],false);

            $this->alert('success', 'Respuesta Enviada!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);

        } elseif($this->person->person_request()->where('publication_id',$this->publication->id)->first()->pivot->estado == "Confirmado") {
            $this->alert('warning', 'Ya se ha confirmado asistencia al evento!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }

        return redirect()->route('applications');
    }

    public function reject(){
        $this->confirm('Quieres rechazar el evento?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);

    }

    public function confirmed()
    {
        // $this->event->delete();

        $this->person->person_request()->updateExistingPivot($this->publication->id,['state'=>'Rechazado'],false);

        $this->alert('success', 'Respuesta enviada, se ha rechazado el evento!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);

        return redirect()->route('applications');
    }

    public function cancelled()
    {
        $this->alert('info', 'cancelado!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);

        
    }
}

<?php

namespace App\Http\Livewire\Admin\Events\Event;

use Livewire\Component;

use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\User\Profile;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PublicationsList extends Component
{
    use LivewireAlert;

    public $publications,$event,$publication;

    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
    ];

    public function mount(Event $event){
        $this->event=Event::find($event->id);
    }

    public function render()
    {
        $this->publications = Publication::where('event_id',$this->event->id)->get();

        return view('livewire.admin.events.event.publications-list');
    }

    public function delete($id){
        $this->publication = Publication::find($id);
        $this->confirm('Quieres elimnar la publicación?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        $this->publication->delete();
        $this->alert('success', 'Publiación Eliminada!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);
    }

    public function cancelled()
    {
        $this->alert('info', 'Cancelado');
    }

    
}

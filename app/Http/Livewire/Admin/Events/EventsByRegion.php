<?php

namespace App\Http\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Location\Region;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class EventsByRegion extends Component
{
    use LivewireAlert;
    public $events,$regions,$event;

    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
    ];

    public function mount(Event $event){
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.admin.events.events-by-region');
    }

    public function delete($id){
        $this->event = Event::find($id);
        $this->confirm('Quieres elimnar el evento?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        $this->event->delete();
        $this->alert('success', 'Evento Eliminado!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);

        $this->emitTo('admin.events.events-list', 'render');
    }

    public function cancelled()
    {
        $this->alert('info', 'Cancelado');
    }
}

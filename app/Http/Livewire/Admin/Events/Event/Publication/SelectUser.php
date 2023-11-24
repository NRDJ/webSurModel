<?php

namespace App\Http\Livewire\Admin\Events\Event\Publication;

use Livewire\Component;
use App\Models\Event\Publication;
use App\Models\User\Person;

class SelectUser extends Component
{
    public $person,$publication;

    public function mount(Person $person, Publication $publication){
        $this->person = $person;
        $this->publication = $publication;
    }

    public function render()
    {
        return view('livewire.admin.events.event.publication.select-user');
    }

    public function selectUSer(){
        $this->person->person_request()->updateExistingPivot($this->publication->id,['state'=>'Preseleccionado'],false);
        $this->emit('render');
    }

    public function unselectUser(){
        $this->person->person_request()->updateExistingPivot($this->publication->id,['state'=>'Pendiente'],false);
        $this->emit('render');
    }
}

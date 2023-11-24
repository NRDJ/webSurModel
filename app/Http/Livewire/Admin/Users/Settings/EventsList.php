<?php

namespace App\Http\Livewire\Admin\Users\Settings;

use Livewire\Component;
use App\Models\User\Person;
use App\Models\Event\Publication;

class EventsList extends Component
{
    public $person,$id_pub;

    public function mount(Person $person,$id_pub){
        $this->person = $person;
        $this->id_pub = $id_pub;
    }

    public function render()
    {
        $ids_publications = $this->person->person_request()->whereIn('person_requests.state',["Pendiente","Preseleccionado","Seleccionado","Confirmado"])->get()->pluck('id')->toArray();
        $publications = Publication::whereIn('id',$ids_publications)->get();

        return view('livewire.admin.users.settings.events-list',[
            'publications' => $publications,
        ]);
    }
}

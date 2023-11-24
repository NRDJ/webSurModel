<?php

namespace App\Http\Livewire\Casting;

use Livewire\Component;
use App\Models\Event\Publication;
use App\Models\User\Person;

class Lists extends Component
{
    public $publication;

    public function mount($publication){
        $this->publication = $publication;
    }

    public function render()
    {
        $people = Person::join('person_requests','person_requests.person_id','=','people.id')
                            // ->whereIn('people.id',$this->values)
                            ->where('person_requests.publication_id',$this->publication->id)
                            ->where('person_requests.state','Preseleccionado')
                            ->select('people.*')
                            ->get();;

        return view('livewire.casting.lists',[
            'people' => $people,
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User\Person;
use App\Models\User\Photo;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Photos extends Component
{
    use LivewireAlert;

    public $person;
    // public $photos;
    public $photo;
    // public $values = [];
    // public $values;
    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
        'updated'
    ];

    public function mount(Photo $photo){
        // $this->person = $person;
        $this->photo = $photo;

    }

    public function render()
    {
        $photos = Photo::where('person_id',$this->person->id)->get();

        $values = $photos->pluck('confirmed')->map(function ($id) {
            return  strval($id);
        })->toArray();

        // dd($this->values);

        $cant =  round( (count($photos)/4),1, PHP_ROUND_HALF_UP );
        

        return view('livewire.admin.users.photos',[
            'cant' => $cant,
            'values' => $values,
            'photos' => $photos,
            'person' => $this->person,
        ]);
    }


}

<?php

namespace App\Http\Livewire\Admin\Events\Event;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\User\Profile;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PublicationsEdit extends Component
{
    use LivewireAlert;

    public $publications,$event,$publication;

    protected $rules = [
        'publication.remuneration' => '',
        'publication.amount' => '',
        'publication.collation' => '',
        'publication.state' => '',
        'publication.date' => '',
        'publication.start_time' => '',
        'publication.time_end' => '',
        'publication.event_id' => '',
        'publication.profile_id' => '',
    ];

    public function mount(Publication $publication){
        $this->publication = Publication::find($publication->id);        
    }

    public function render()
    {
        $profiles = Profile::all();
        return view('livewire.admin.events.event.publications-edit',[
            'profiles'=>$profiles,
        ]);
    }

    public function update(){

        $validateData = $this->validate([
            'publication.remuneration' => ['required','numeric','min:1','not_in:0'],
            'publication.amount' => ['required','numeric','min:1','not_in:0'],
            'publication.collation' => ['required'],
            'publication.state' => ['required'],
            'publication.profile_id' => ['required'],
        ],        
        [
            'publication.remuneration.required' => "El campo es requerido",
            'publication.remuneration.numeric' => "El campo debe ser numerico",
            'publication.remuneration.min' => "El campo debe ser minimo 1",
            'publication.remuneration.not_in' => "El campo no puede ser 0",
            'publication.amount.required' => "El campo es requerido",
            'publication.amount.numeric' => "El campo debe ser numerico",
            'publication.amount.min' => "El campo debe ser minimo 1",
            'publication.amount.not_in' => "El campo no puede ser 0",
            'publication.collation.required' => "El campo es requerido",
            'publication.state.required' => "El campo es requerido",
            'publication.profile_id.required' => "El campo es requerido",
        ]);

        $this->publication->save();

        $this->alert('success', 'Publicacion Actualizada!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);

        $this->emitTo('admin.events.event.publications-list', 'render');
    }
}

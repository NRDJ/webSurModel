<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\User\Profile;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ProfileCreate extends Component
{
    use LivewireAlert;
    public $name,$description;

    public function render()
    {
        return view('livewire.admin.profile.profile-create');
    }

    public function save(){

        $validateData = $this->validate([
            'name' => ['required','unique:profiles'],
        ],        
        [
            'name.required'=>"el campo nombre es requerido",
            'name.unique'=>"ya existe un campo con el este nombre",
        ]);

        Profile::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->alert('success', 'Perfil agregado!!', [
            'position' =>  'center', 
            'timer' =>  3000,  
            'toast' =>  false,
        ]);

        $this->reset('name','description');
        $this->emitTo('admin.profile.profile-list', 'render');
    }
}

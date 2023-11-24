<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\User\Profile;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfileEdit extends Component
{
    use LivewireAlert;
    
    public $profile;
    
    protected $rules = [
        'profile.name' => '',
        'profile.description' => '',
    ];

    public function mount(Profile $profile){
        $this->profile = Profile::find($profile->id);
    }

    public function render()
    {
        return view('livewire.admin.profile.profile-edit');
    }

    public function update(){

        $validateData = $this->validate([
            'profile.name' => ['required','unique:profiles,name,'.$this->profile->id],
        ],        
        [
            'profile.name.required'=>"el campo nombre es requerido",
            'profile.name.unique'=>"ya existe un campo con el este nombre",
        ]);

        $this->profile->save();

        $this->alert('success', 'Perfil Actualizado!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);

        $this->emitTo('admin.profile.profile-list', 'render');
    }

}

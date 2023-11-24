<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;

use App\Models\User\Profile;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfileList extends Component
{
    use LivewireAlert;

    public $profiles,$profile;

    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
    ];

    public function render()
    {
        $this->profiles = Profile::all();
        return view('livewire.admin.profile.profile-list');
    }

    public function delete($id){
        $this->profile = Profile::find($id);
        $this->confirm('Quieres elimnar el perfil?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        $this->profile->delete();
        $this->alert('success', 'Perfil Eliminado!', [
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

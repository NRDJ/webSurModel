<?php

namespace App\Http\Livewire\User\Applications;

use Livewire\Component;
use App\Models\User;
use App\Models\Event\Publication;

class Detail extends Component
{
    public $publication, $user;

    public function mount(Publication $publication, User $user)
    {
        $this->publication = $publication;
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user.applications.detail');
    }
}

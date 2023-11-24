<?php

namespace App\Http\Livewire\User\Applications;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\User\Profile;
use App\Models\User;
use App\Models\User\PersonRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Applications extends Component
{
    use LivewireAlert;

    public $user,$publications;

    public function mount(User $user){
        $this->user = User::find($user->id);
    }

    public function render()
    {
        
        // $this->publications = Publication::where('event_id',$this->event->id)->get();
        $ids_publications = PersonRequest::where('person_id',$this->user->person->id)->get()->pluck('id');
        

        $this->publications = Publication::whereIn('id',$ids_publications)->get();
        return view('livewire.user.applications.applications');
    }

    //copilot
    public function calculateAge($birthday)
    {
        $birthday = new \DateTime($birthday);
        $now = new \DateTime();
        $interval = $now->diff($birthday);
        return $interval->y;
    }
}

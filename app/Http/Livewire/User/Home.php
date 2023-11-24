<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\User\Profile;
use App\Models\User;
use App\Models\User\PersonRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Home extends Component
{
    use LivewireAlert;

    public $user,$publications,$publication;

    public function mount(User $user){
        $this->user = User::find($user->id);
    }

    public function render()
    {
        // $this->publications = Publication::where();

        $this->publications = Publication::join('events','events.id','=','publications.event_id')
                                        ->where('events.state','Activo')    
                                        ->where('publications.state','Activo')    
                                        ->select('publications.*')
                                        ->orderBy('events.start_date', 'DESC')
                                        ->get();
        // Person::join('person_requests','person_requests.person_id','=','people.id')
        //                 ->whereIn('people.id',$this->values)
        //                 ->where('person_requests.publication_id',$this->publication->id)
        //                 ->where('person_requests.estado','Confirmado')
        //                 ->select('people.*')
        //                 ->get();
        

        return view('livewire.user.home');
    }

    public function enroll($id){

        $this->publication = Publication::find($id);
        $pr= PersonRequest::where('person_id',$this->user->person->id)
                            ->where('publication_id',$this->publication->id)
                            ->get();
        
        if($pr->count()){
            $this->alert('error', 'Ya estas inscrito!!', [
                'position' =>  'center', 
                'timer' =>  3000,  
                'toast' =>  false,
            ]);
        }
        else{
            $this->publication->person_request()->attach($this->user->person,['state'=> "Pendiente" ]);    
            
            $this->alert('success', 'Inscripción exitosa!!', [
                'position' =>  'center', 
                'timer' =>  3000,  
                'toast' =>  false,
            ]);
            
        }

        // $this->alert('success', 'Postulación hecha!', [
        //     'position' => 'center',
        //     'timer' => 3000,
        //     'toast' => false,
        //     ]);
    }
}

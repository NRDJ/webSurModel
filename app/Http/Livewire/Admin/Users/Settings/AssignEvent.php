<?php

namespace App\Http\Livewire\Admin\Users\Settings;

use Livewire\Component;
use App\Models\User;
use App\Models\User\Person;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\User\Profile;
use App\Models\User\PersonRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AssignEvent extends Component
{
    use LivewireAlert;

    public $user,$person,$events,$publications,$profiles,$personRequest;
    public $publication,$publication_id;

    public function mount(User $user){
        $this->user = $user;
        $this->person = $user->person;
        $this->events = Event::where('state','Activo')->get();
        // $this->publications = Publication::all();
        $this->profiles = Profile::all();
    }

    public function render()
    {
        return view('livewire.admin.users.settings.assign-event');
    }

    public function onChangeEvent($id)
    {   
        $this->publications = Publication::join('events','publications.event_id','=','events.id')
                                        ->where('publications.event_id',$id)
                                        ->where('publications.state','Activo')
                                        ->where('events.state','Activo')
                                        ->select('publications.*')
                                        ->orderBy('publications.profile_id')
                                        ->get();
    }

    public function assign(){
        if($this->publication_id){
            $this->publication = Publication::find($this->publication_id);
            
            $pr= PersonRequest::where('person_id',$this->user->person->id)
                            ->where('publication_id',$this->publication->id)
                            ->get();
        
            if($pr->count()){
                $this->alert('error', 'El usuario ya esta inscrito!!', [
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

        }
        else{
            $this->alert('error', 'Debe asignar una publicación al usuario!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                ]);
        }

    }
}

<?php

namespace App\Http\Livewire\Site;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\Location\Region;
use App\Models\Location\City;
use App\Models\User\Profile;

use Livewire\Component;

class Events extends Component
{
    public $profile_id,$region_id,$cities;

    public function mount(){

        $this->profile_id = Profile::orderBy('name','ASC')->get();
        $this->region_id = Region::orderBy('name','ASC')->get();
        $this->cities = City::orderBy('name','ASC')->get();
    }

    public function render()
    {
        // $profiles = Profile::orderBy('name','ASC')->get();

        $profiles = Publication::join('profiles', 'publications.profile_id', '=', 'profiles.id')
                                        ->join('events', 'publications.event_id', '=', 'events.id')
                                        ->select('profiles.*')
                                        ->where('events.state','Activo')
                                        ->where('publications.state','Activo')
                                        ->groupBy('profiles.id')
                                        ->get();

        $regions = Publication::join('events', 'publications.event_id', '=', 'events.id')
                                    ->join('cities', 'events.city_id', '=', 'cities.id')
                                    ->join('regions', 'cities.region_id', '=', 'regions.id')
                                    ->select('regions.*')
                                    ->where('events.state','Activo')
                                    ->where('publications.state','Activo')
                                    ->groupBy('regions.id')
                                    ->get();
        

        $publications = Publication::join('events','events.id','=','publications.event_id')
                                        ->where('events.state','Activo')    
                                        ->where('publications.state','Activo')
                                        ->whereIn('publications.profile_id',$this->profile_id->pluck('id'))
                                        ->whereIn('events.city_id',$this->cities->pluck('id'))
                                        ->select('publications.*')
                                        ->orderBy('events.start_date', 'DESC')
                                        ->get();

        return view('livewire.site.events',[
            'profiles' => $profiles,
            'regions' => $regions,
            'publications' => $publications,
        ]);
    }

    public function filtroPerfiles($id){
        if($id!=null){
            $this->profile_id = Profile::where('id',$id)->get();
        }
        else{
            $this->profile_id = Profile::all();
        }
    }

    public function filtroRegion($id){
        if($id!=null){
            $this->cities = City::where('region_id',$id)->orderBy('name','ASC')->get();
        }
        else{
            $this->cities = City::orderBy('name','ASC')->get();
        }
    }
}

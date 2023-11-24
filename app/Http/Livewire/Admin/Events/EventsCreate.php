<?php

namespace App\Http\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Location\Region;
use App\Models\Location\City;
use App\Models\User\Sponsor;

use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Facades\Storage;

class EventsCreate extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $name,$path_image,$slug,$description,$start_date,$end_date,$number_days,$start_time,$time_end,$state,$sponsor_id,$city_id;
    public $regions, $cities, $region_id,$sponsors, $image;
    public $identificador;
    
    public function mount(){
        $this->identificador = rand();
    }

    public function render()
    {
        $this->regions = Region::all();
        $this->sponsors = Sponsor::all();        

        return view('livewire.admin.events.events-create');
    }

    public function onChangeRegion($region_id)
    {      
        $this->cities = City::where('region_id',$region_id)->orderBy('name')->get();
        // $this->city_id = null;
        // $this->regions = Region::all();
    }

    public function save(){

        $validateData = $this->validate([
            'name' => ['required','unique:events'],
            'image' => ['nullable','image','max:1024'],
            // 'description' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'number_days' => ['numeric','min:1','not_in:0'],
            // 'start_time' => ['required'],
            // 'time_end' => ['required'],
            'city_id' => ['required'],
            'sponsor_id' => ['required'],
        ],        
        [
            'name.required'=>"el campo nombre es requerido",
            'name.unique'=>"ya existe un campo con el este nombre",
            'image.image'=>"el campo debe ser una imagen",
            'image.1024'=>"el tamaño de la imagen debe ser 1mb",
            // 'description.required'=>"el campo descripcion es requerido",
            'start_date.required'=>"el campo fecha de inicio es requerido",
            'end_date.required'=>"el campo fecha de termino es requerido",
            // 'number_days.required'=>"el campo cantidad de dias es requerido",
            'number_days.numeric'=>"el campo cantidad de dias debe ser numerico",
            'number_days.min'=>"el valor minimo permitido es 1",
            'number_days.not_in'=>"el valor 0 no esta permitido",
            // 'start_time.required'=>"el campo horario de inicio es requerido",
            // 'time_end.required'=>"el campo horario de termino es requerido",
            'city_id.required'=>"el campo comuna es requerido",
            'sponsor_id.required'=>"el campo sponsor es requerido",
        ]);

        $this->state = "Borrador";

        if($this->image!=null){
            $this->image->store('events');
            $image = $this->image->hashName();
        }
        else{
            $image = "";
        }

        Event::create([
            'name' => $this->name,
            'slug' => Str::of($this->name)->slug('-'),
            'path_image' => $image,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'number_days' => $this->number_days,
            'start_time' => $this->start_time,
            'time_end' => $this->time_end,
            'state' => $this->state,
            'city_id' => $this->city_id,
            'sponsor_id' => $this->sponsor_id
        ]); 

        $this->alert('success', 'Evento Creado!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);
        
        $this->identificador = rand();
        $this->reset('name','path_image','slug','description','start_date','end_date','number_days','start_time','time_end','state','sponsor_id','city_id');
        $this->emitTo('admin.events.events-list', 'render');
        // $this->emitTo('admin.events.events-by-region', 'render');
    }

    public function close(){
        $this->reset(['name','description','start_date','end_date','number_days','start_time','time_end','city_id']);
    }
}

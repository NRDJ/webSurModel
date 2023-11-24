<?php

namespace App\Http\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\User\Sponsor;
use App\Models\Event\Event;
use App\Models\Location\Region;
use App\Models\Location\City;

use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;

class EventsEdit extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $image, $event;
    public $name,$path_image,$slug,$description,$start_date,$end_date,$number_days,$start_time,$time_end,$state,$sponsor_id,$city_id;
    public $regions, $cities, $region_id,$sponsors;
    public $identificador;

    protected $rules = [
        'event.name' => '',
        'event.path_image' => '',
        'event.description' => '',
        'event.start_date' => '',
        'event.end_date' => '',
        'event.number_days' => '',
        'event.start_time' => '',
        'event.time_end' => '',
        'event.state' => '',
        'event.sponsor_id' => '',
        'event.city_id' => '',
    ];

    public function mount(Event $event){
        $this->event = Event::find($event->id);
        $this->identificador = rand();
        $this->cities = City::where('region_id',$this->event->city->region->id)->orderBy('name')->get();
        $this->region_id = $this->event->city->region->id;
    }

    public function render()
    {
        $this->regions = Region::all();
        $this->sponsors = Sponsor::all();        

        return view('livewire.admin.events.events-edit');
    }

    public function onChangeRegion($region_id)
    {      
        $this->cities = City::where('region_id',$region_id)->orderBy('name')->get();
    }

    public function update(){

        $validateData = $this->validate([
            'event.name' => ['required','unique:events,name,'.$this->event->id],
            'event.image' => ['nullable','image','max:1024'],
            'event.start_date' => ['required'],
            'event.end_date' => ['required'],
            'event.number_days' => ['numeric','min:1','not_in:0'],
            'event.city_id' => ['required'],
            'event.sponsor_id' => ['required'],
        ],        
        [
            'event.name.required'=>"el campo nombre es requerido",
            'event.name.unique'=>"ya existe un campo con el este nombre",
            'event.image.image'=>"el campo debe ser una imagen",
            'event.image.1024'=>"el tamaño de la imagen debe ser 1mb",
            'event.start_date.required'=>"el campo fecha de inicio es requerido",
            'event.end_date.required'=>"el campo fecha de termino es requerido",
            'event.number_days.numeric'=>"el campo cantidad de dias debe ser numerico",
            'event.number_days.min'=>"el valor minimo permitido es 1",
            'event.number_days.not_in'=>"el valor 0 no esta permitido",
            'event.city_id.required'=>"el campo comuna es requerido",
            'event.sponsor_id.required'=>"el campo sponsor es requerido",
        ]);

        if($this->image!=null){
            $path = "events/{$this->event->path_image}";
            
            if(Storage::exists($path)){
                Storage::delete($path);
            }
            $this->image->store('events');
            // $this->image = $this->image->hashName();
            $this->event->path_image = $this->image->hashName();
        }
        
        $this->event->save();
        
        $this->identificador = rand();

        $this->alert('success', 'Evento Actualizado!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);

        // $this->emitTo('admin.events.events-list', 'render');
        $this->emitTo('admin.events.events-by-region', 'render');
    }
}

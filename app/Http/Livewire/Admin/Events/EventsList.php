<?php

namespace App\Http\Livewire\Admin\Events;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Location\Region;
use App\Models\Location\City;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class EventsList extends Component
{

    use LivewireAlert;
    // public $event;
    public $search;
    public $regiones,$ciudades,$region_id;

    public $filters = [
        'states' => [
            'Activo' => true,
            'Borrador' => true,
            'Finalizado' => false,
            'Cancelado' => false,
        ],
    ];

    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
    ];

    public function mount(){
        $this->regiones = Region::all();
        // $this->cities = City::whereIn('region_id',$this->regions->pluck('id'))->get();
        $this->ciudades = null;
    }

    public function render()
    {
        $this->filters['states'] = array_filter($this->filters['states']);
        $regions = Region::all(); 
        // $this->events = Event::all();
        $events = Event::whereIn('state',array_keys($this->filters['states']))
                        // where('name','like','%'.$this->search.'%')
                        // ->whereIn('state',array_keys($this->filters['estados']))
                        // ->whereMonth('fecha_inicio',$this->month)
                        // ->whereYear('fecha_inicio',$this->year)
                        // ->whereIn('city_id',City::whereIn('region_id',$this->region_id->pluck('id'))->get()->pluck('id'))
                        // ->whereIn('city_id',$this->cities->pluck('id'))
                        // ->whereIn('sponsor_id',$this->sponsor->pluck('id'))
                        ->orderBy('created_at','desc')->get();

        return view('livewire.admin.events.events-list',[
            'events'=>$events,
            'regions'=>$regions,
        ]);
    }

    public function onChangeRegion($region_id)
    {   
        // dd($this->region_id);

        // $open_region='open';
        // $this->emit('render');
        // if($region_id!=null){
        //     $this->cities = City::where('region_id',$region_id)->get();
        //     $this->ciudades = City::where('region_id',$region_id)->orderBy('name','ASC')->get();
        // }
        // else{
        //     $this->ciudades = null;
        //     $this->regions = Region::all();
        //     $this->cities = City::all();
        // }   
    }

    // public function delete($id){
    //     $this->event = Event::find($id);
    //     $this->confirm('Quieres elimnar el evento?', [
    //         'toast' => false,
    //         'position' => 'center',
    //         'showConfirmButton' => true,
    //         'onConfirmed' => 'confirmed',
    //         'onCancelled' => 'cancelled'
    //     ]);
    // }

    // public function confirmed()
    // {
    //     $this->event->delete();
    //     $this->alert('success', 'Evento Eliminado!', [
    //         'position' => 'top-end',
    //         'timer' => 3000,
    //         'toast' => true,
    //         ]);
    // }

    // public function cancelled()
    // {
    //     $this->alert('info', 'Cancelado');
    // }
}

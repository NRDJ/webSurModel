<?php

namespace App\Http\Livewire\Admin\Events\Event;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\User\Profile;
use App\Models\User\PersonRequest;
use App\Models\User;
use App\Models\User\Person;
use App\Models\User\Feature;
use App\Models\Location\Region;
use App\Models\Location\City;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use Carbon\Carbon;

use App\Mail\SendNotification;
use App\Mail\SendNotificationPaymentDate;
use Illuminate\Support\Facades\Mail;


class PublicationDetail extends Component
{
    use LivewireAlert;

    public $users,$people, $publication;

    //filtro ubicacion
    public $search;
    public $regions,$region,$cities,$region_id,$city_id,$ciudades;
    //filtro person
    public $genders,$gender_id,$eyes_color,$hair_color,$height,$weight,$shirt_size,$pants_size,$ages,$years;
    //checkbox
    public $values = [];

    public $filters = [
        'estados' => [
            'Pendiente' => true,
            'Preseleccionado' => true,
            'Seleccionado' => true,
            'Confirmado' => true,
            'Rechazado' => true,
        ],
    ];

    protected $listeners = [
        'render' =>'render',
        'confirmed',
        'cancelled',
    ];

    public function mount(Publication $publication){
        $this->publication = $publication;

        $this->regions = Region::all();
        $this->cities = City::whereIn('region_id',$this->regions->pluck('id'))->get();
        $this->ciudades = null;
        $this->genders = ['Masculino','Femenino','Otro'];
        $this->eyes_color = ['castaños','miel','verdes','azules','grises','negros','otros'];
        $this->hair_color = Feature::distinct()->get(['hair_color'])->pluck('hair_color')->toArray();
        $this->height = Feature::distinct()->get(['height'])->pluck('height')->toArray();
        $this->weight = Feature::distinct()->get(['weight'])->pluck('weight')->toArray();
        $this->shirt_size = ['XS','S','M','L','XL'];
        $this->pants_size = ['XS','S','M','L','XL'];
        $this->years = Person::select(DB::raw('YEAR(birth_date) as year'))->distinct()->get()->toArray();
    }

    public function render()
    {   
        $person_ids = PersonRequest::where('publication_id',$this->publication->id)->get()->pluck('person_id');

        $users_ids = Person::whereIn('id',$person_ids)->get()->pluck('user_id');
        $this->users = User::whereIn('id',$users_ids)->get();

        //new
        $min_age = Carbon::parse(Person::max('birth_date'))->diff(Carbon::now())->format('%y');
        $max_age = Carbon::parse(Person::min('birth_date'))->diff(Carbon::now())->format('%y');

        $list_hair_color = Feature::distinct()->get(['hair_color'])->pluck('hair_color')->toArray();
        $list_height = Feature::distinct()->get(['height'])->pluck('height')->toArray();
        $list_weight = Feature::distinct()->get(['weight'])->pluck('weight')->toArray();

        $this->filters['estados'] = array_filter($this->filters['estados']);

        $this->people = Person::join('person_requests','person_requests.person_id','=','people.id')
                                ->where('person_requests.publication_id',$this->publication->id)
                                ->whereIn('person_requests.state',array_keys($this->filters['estados']))
                                ->join('features', 'people.id', '=', 'features.person_id')
                                ->whereIn('people.gender',$this->genders)
                                ->whereIn('features.eyes_color',$this->eyes_color)
                                ->whereIn('features.hair_color',$this->hair_color)
                                ->whereIn('features.height',$this->height)
                                ->whereIn('features.weight',$this->weight)
                                ->whereIn('features.shirt_size',$this->shirt_size)
                                ->whereIn('features.pants_size',$this->pants_size)
                                ->whereIn('people.city_id',$this->cities->pluck('id'))
                                ->whereIn(DB::raw("year(birth_date)"), $this->years)
                                ->where('people.rut','like','%'.$this->search.'%')
                                ->select('people.*')
                                ->get();

        return view('livewire.admin.events.event.publication-detail',[
            'list_hair_color' => $list_hair_color,
            'list_height' => $list_height,
            'list_weight' => $list_weight,
            'min_age' => $min_age,
            'max_age' => $max_age,
        ]);
    }

    //Filtros
    public function onChangeRegion($region_id)
    {   
        if($region_id!=null){
            $this->cities = City::where('region_id',$region_id)->get();
            $this->ciudades = City::where('region_id',$region_id)->orderBy('name','ASC')->get();
        }
        else{
            $this->ciudades = null;
            $this->regions = Region::all();
            $this->cities = City::all();
        }   
    }

    public function onChangeCity($id)
    {   
        if($id!=null){
            $this->cities = City::where('id',$id)->get();
        }
        else{
            $this->cities = City::where('region_id',$this->region_id)->get();
        }   
    }

    public function onChangeGeneros($gender){
        if($gender!=null){
            $this->genders = [];
            $this->genders[] = $gender;
        }
        else{
            $this->genders = ['Masculino','Femenino','Otro'];
        }   
    }

    public function onChangeColorOjos($eyes_color){
        if($eyes_color!=null){
            $this->eyes_color = [];
            $this->eyes_color[] = $eyes_color;
        }
        else{
            $this->eyes_color = ['castaños','miel','verdes','azules','grises','negros','otros'];
        }
    }

    public function onChangeColorPelo($hair_color){
        // dd($hair_color);
        if($hair_color!=null){
            $this->hair_color = [];
            $this->hair_color[] = $hair_color;
        }
        else{
            $this->hair_color = Feature::distinct()->get(['hair_color'])->pluck('hair_color')->toArray();
        }
    }

    public function onChangeEstaura($height){
        if($height!=null){
            $this->height = [];
            $this->height[] = $height;
        }
        else{
            $this->height = Feature::distinct()->get(['height'])->pluck('height')->toArray();
        }
    }

    public function onChangePeso($weight){
        if($weight!=null){
            $this->weight = [];
            $this->weight[] = $weight;
        }
        else{
            $this->weight = Feature::distinct()->get(['weight'])->pluck('weight')->toArray();
        }
    }

    public function onChangeTallaPolera($value){
        if($value!=null){
            $this->shirt_size = [];
            $this->shirt_size[] = $value;
        }
        else{
            $this->shirt_size = ['XS','S','M','L','XL'];
        }
    }

    public function onChangeTallaPantalon($value){
        if($value!=null){
            $this->pants_size = [];
            $this->pants_size[] = $value;
        }
        else{
            $this->pants_size = ['XS','S','M','L','XL'];
        }
    }

    public function onChangeAge($age){

        if($age!=null){
            $this->years = [];
            $this->years[] = (int)Carbon::now()->format('Y') - $age;
            // dd($this->years);
        }
        else{
            $this->years = Person::select(DB::raw('YEAR(birth_date) as year'))->distinct()->get()->toArray();
        }
    }

    //notificación
    public function sendMail(){

        $people = Person::join('person_requests','person_requests.person_id','=','people.id')
                        ->whereIn('people.id',$this->values)
                        ->where('person_requests.publication_id',$this->publication->id)
                        ->where('person_requests.state','Preseleccionado')
                        ->select('people.*')
                        ->get();;

        foreach($people as $p){
            Mail::to($p->user->email)->send(new SendNotification($p,$this->publication));
            $p->person_request()->updateExistingPivot($this->publication->id,['state'=>'Seleccionado'],false);

        }       

        $this->alert('success', 'Notificacion(es) enviada(s)!!', [
            'position' =>  'center', 
            'timer' =>  3000, 
            'toast' =>  false,
        ]);

        $this->emit('render');
    }

    public function sendMailPaymentDays(){
        
        $people = Person::join('person_requests','person_requests.person_id','=','people.id')
                            ->whereIn('people.id',$this->values)
                            ->where('person_requests.publication_id',$this->publication->id)
                            ->where('person_requests.state','Confirmado')
                            ->select('people.*')
                            ->get();;

                            
        foreach($people as $person){
            Mail::to($person->user->email)->send(new SendNotificationPaymentDate($person,$this->publication));
        }       

        $this->alert('success', 'Notificacion(es) enviada(s)!!', [
                    'position' =>  'center', 
                    'timer' =>  3000, 
                    'toast' =>  false,
        ]);

        $this->emit('render');

    }
    
}

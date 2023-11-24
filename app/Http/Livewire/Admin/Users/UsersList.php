<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\User\Person;
use App\Models\User\Feature;
use App\Models\Location\Region;
use App\Models\Location\City;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use Carbon\Carbon;
use Livewire\WithPagination;


class UsersList extends Component
{
    use LivewireAlert;
    use WithPagination;

    // public $users,$user;

    //filtro ubicacion
    public $search="";
    public $regions,$region,$cities,$region_id,$city_id,$ciudades;
    //filtro person
    public $genders,$gender_id,$eyes_color,$hair_color,$height,$weight,$shirt_size,$pants_size,$ages,$years;
    //
    public $showFullProfile = false;
    public $whitoutPerson = false;

    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
    ];

    public function mount(){

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
        //filters
        $min_age = Carbon::parse(Person::max('birth_date'))->diff(Carbon::now())->format('%y');
        $max_age = Carbon::parse(Person::min('birth_date'))->diff(Carbon::now())->format('%y');

        $list_hair_color = Feature::distinct()->get(['hair_color'])->pluck('hair_color')->toArray();
        $list_height = Feature::distinct()->get(['height'])->pluck('height')->toArray();
        $list_weight = Feature::distinct()->get(['weight'])->pluck('weight')->toArray();
        
        // $this->users = User::all();
        $users = User::orderBy('created_at', 'desc')->paginate();
        // dd($this->cities);

        if( $this->showFullProfile && !$this->whitoutPerson ){

            $users = User::join('people','people.user_id','=','users.id')
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
                                ->where(function ($query){
                                    $query->where('people.name', 'like', '%' . explode(" ", $this->search)[0] . '%');
                                    if(count(explode(" ", $this->search))>1){
                                        $query->where('people.name', 'like', '%' . explode(" ", $this->search)[0] . '%')
                                        ->Where('people.last_name', 'like', '%' . explode(" ", $this->search)[1]. '%');
                                    }
                                  })
                                ->select('users.*')
                                ->orderBy('users.created_at', 'desc')
                                ->paginate(20);
        }
        elseif( $this->whitoutPerson && !$this->showFullProfile ){
            $users = User::whereDoesntHave('person')->whereNot('role_id',1)->orderBy('users.created_at', 'desc')->paginate(20);
        }



        return view('livewire.admin.users.users-list',[
            'list_hair_color' => $list_hair_color,
            'list_height' => $list_height,
            'list_weight' => $list_weight,
            'min_age' => $min_age,
            'max_age' => $max_age,
            'users' => $users,
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

    public function delete($id){
        $this->user = User::find($id);
        $this->confirm('Quieres elimnar el usuario '.$this->user->name.'?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        $this->user->delete();
        $this->alert('success', 'Usuario Eliminado!', [
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

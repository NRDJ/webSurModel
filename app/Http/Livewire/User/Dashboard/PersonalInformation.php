<?php

namespace App\Http\Livewire\User\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\User\Person;
use App\Models\User\Feature;
use App\Models\Payment\TransferAccount;

use App\Models\Location\Region;
use App\Models\Location\City;
use App\Models\Location\Country;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PersonalInformation extends Component
{
    use LivewireAlert;

    public $user,$person,$feature,$transfer_account;
    public $username, $email;
    public $rut,$name,$last_name,$gender,$birth_date,$phone,$instagram,$user_id,$country_id,$city_id;
    public $eyes_color,$hair_color,$height,$weight,$shirt_size,$pants_size,$profession,$person_id;
    // public $bank,$account_type,$account_number;      
    public $regions,$cities,$countries,$region_id;

    public function mount(User $user){
        $this->user = User::find($user->id);

        $person = Person::where('user_id',$this->user->id)->first();

        if($person){
            $this->rut = $person->rut;
            $this->name = $person->name;
            $this->last_name = $person->last_name;
            $this->birth_date = $person->birth_date;
            $this->phone = $person->phone;
            $this->gender = $person->gender;
            $this->country_id = $person->country_id;
            $this->city_id = $person->city_id;
            $this->instagram = $person->instagram;

            if($person->features){
                $this->eyes_color = $person->features->eyes_color;
                $this->hair_color = $person->features->hair_color;
                $this->height = $person->features->height;
                $this->weight = $person->features->weight;
                $this->shirt_size = $person->features->shirt_size;
                $this->pants_size = $person->features->pants_size;
                $this->profession = $person->features->profession;
            }
            else{
                $this->height=150;
                $this->weight=50;
                $this->country_id = 39;
            }

            // if($person->transfer_account){
            //     $this->bank = $person->transfer_account->bank;
            //     $this->account_type = $person->transfer_account->account_type;
            //     $this->account_number = $person->transfer_account->account_number;
            // }

            $this->region_id = $person->city->region_id;
            $this->cities = City::where('region_id',$person->city->region_id)->orderBy('name')->get();
            
        }
        else{
            $this->height=150;
            $this->weight=50;
            $this->country_id = 39;
        }

    }

    public function render()
    {
        $this->regions = Region::all();
        $this->countries = Country::all();

        return view('livewire.user.dashboard.personal-information');
    
    }

    public function onChangeRegion($id)
    {   
        $this->cities = City::where('region_id',$id)->orderBy('name')->get();
    }

    public function update(){

        $person = Person::where('user_id',$this->user->id)->first();
        if($person){
            $validateData = $this->validate([
                'rut' => ['required','unique:people,rut,'.$person->id],
                // 'event.name' => ['required','unique:events,name,'.$this->event->id],
                'name' => ['required','min:2'],
                'last_name' => ['required','min:2'],
                'birth_date' => ['required'],
                'phone' => ['required','numeric','min:8'],
                'gender' => 'required',
                'country_id' => 'required',
                'city_id' => 'required',
                'eyes_color' => 'required',
                'hair_color' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'shirt_size' => 'required',
                'pants_size' => 'required',
                // 'bank' => 'required',
                // 'account_type' => 'required',
                // 'account_number' => 'required',
                'region_id' => 'required',
            ],
            [
                'rut.required'=>"el campo rut es requerido",
                'rut.unique'=>"ya existe un campo con este registro",
                'name.min'=>"el campo nombre debe contener al menos 2 caracteres",
                'name.required'=>"el campo nombre es requerido",
                'last_name.required'=>"el campo apellido es requerido",
                'last_name.min'=>"el campo apellido debe contener al menos 2 caracteres",
                'gender.required'=>"el campo genero es requerido",
                'birth_date.required'=>"el campo fecha de nacimiento es requerido",
                'phone.numeric'=>"el campo telefono debe ser numerico",
                'phone.required'=>"el campo telefono es requerido",
                'phone.min'=>"el campo telefono debe contener al menos 8 digitos",
                'country_id.required'=>"el campo nacionalidad es requerido",
                'city_id.required'=>"el campo comuna es requerido",
                'eyes_color.required'=>"el campo color de ojos es requerido",
                'hair_color.required'=>"el campo color de pelo es requerido",
                'height.required'=>"el campo altura es requerido",
                'weight.required'=>"el campo peso es requerido",
                'shirt_size.required'=>"el campo talla de pantalón es requerido",
                'pants_size.required'=>"el campo talla de polera es requerido",
                // 'bank.required'=>"el campo institución bancaria es requerido",
                // 'account_type.required'=>"el campo tipo de cuenta es requerido",
                // 'account_number.required'=>"el campo número de cuenta es requerido",
            ]);
        }else{
            $validateData = $this->validate([
                'rut' => ['required','unique:people'],
                'name' => ['required','min:2'],
                'last_name' => ['required','min:2'],
                'birth_date' => ['required'],
                'phone' => ['required','numeric','min:8'],
                'gender' => 'required',
                'country_id' => 'required',
                'city_id' => 'required',
                'eyes_color' => 'required',
                'hair_color' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'shirt_size' => 'required',
                'pants_size' => 'required',
                // 'bank' => 'required',
                // 'account_type' => 'required',
                // 'account_number' => 'required',
                'region_id' => 'required',
            ],
            [
                'rut.required'=>"el campo rut es requerido",
                'rut.unique'=>"ya existe un campo con este registro",
                'name.min'=>"el campo nombre debe contener al menos 2 caracteres",
                'name.required'=>"el campo nombre es requerido",
                'last_name.required'=>"el campo apellido es requerido",
                'last_name.min'=>"el campo apellido debe contener al menos 2 caracteres",
                'gender.required'=>"el campo genero es requerido",
                'birth_date.required'=>"el campo fecha de nacimiento es requerido",
                'phone.numeric'=>"el campo telefono debe ser numerico",
                'phone.required'=>"el campo telefono es requerido",
                'phone.min'=>"el campo telefono debe contener al menos 8 digitos",
                'country_id.required'=>"el campo nacionalidad es requerido",
                'city_id.required'=>"el campo comuna es requerido",
                'eyes_color.required'=>"el campo color de ojos es requerido",
                'hair_color.required'=>"el campo color de pelo es requerido",
                'height.required'=>"el campo altura es requerido",
                'weight.required'=>"el campo peso es requerido",
                'shirt_size.required'=>"el campo talla de pantalón es requerido",
                'pants_size.required'=>"el campo talla de polera es requerido",
                // 'bank.required'=>"el campo institución bancaria es requerido",
                // 'account_type.required'=>"el campo tipo de cuenta es requerido",
                // 'account_number.required'=>"el campo número de cuenta es requerido",
            ]);
        }
        

        if($person){
            $person->update([
                'rut' => $this->rut,
                'name' => $this->name,
                'last_name' => $this->last_name,
                'gender' => $this->gender,
                'birth_date' => $this->birth_date,
                'phone' => $this->phone,
                'country_id' => $this->country_id,
                'city_id' => $this->city_id,
                'instagram'=> $this->instagram,
            ]);

            if($person->features){
                $person->features->update([
                    'eyes_color' => $this->eyes_color,
                    'hair_color' => $this->hair_color,
                    'height' => $this->height,
                    'weight' => $this->weight,
                    'shirt_size' => $this->shirt_size,
                    'pants_size' => $this->pants_size,
                    'profession'=> $this->profession,
                ]);
            }
            else{
                Feature::create([
                    'eyes_color' => $this->eyes_color,
                    'hair_color' => $this->hair_color,
                    'height' => $this->height,
                    'weight' => $this->weight,
                    'shirt_size' => $this->shirt_size,
                    'pants_size' => $this->pants_size,
                    'profession'=> $this->profession,
                    'person_id'=> $person->id,
                ]);
            }


            // if($person->transfer_account){
            //     $person->transfer_account->update([
            //         'bank' => $this->bank,
            //         'account_type' => $this->account_type,
            //         'account_number' => $this->account_number,
            //     ]);
            // }
            // else{
            //     TransferAccount::create([
            //         'bank' => $this->bank,
            //         'account_type' => $this->account_type,
            //         'account_number' => $this->account_number,
            //         'person_id'=> $person->id,
            //     ]);
            // }

        }else{
            Person::create([
                'rut' => $this->rut,
                'name' => $this->name,
                'last_name' => $this->last_name,
                'gender' => $this->gender,
                'birth_date' => $this->birth_date,
                'phone' => $this->phone,
                'user_id' => $this->user->id,
                'country_id' => $this->country_id,
                'instagram'=> $this->instagram,
                'city_id' => $this->city_id,
            ]);
            $person = Person::where('user_id',$this->user->id)->first();

            Feature::create([
                'eyes_color' => $this->eyes_color,
                'hair_color' => $this->hair_color,
                'height' => $this->height,
                'weight' => $this->weight,
                'shirt_size' => $this->shirt_size,
                'pants_size' => $this->pants_size,
                'profession'=> $this->profession,
                'person_id'=> $person->id,
            ]);

            // TransferAccount::create([
            //     'bank' => $this->bank,
            //     'account_type' => $this->account_type,
            //     'account_number' => $this->account_number,
            //     'person_id'=> $person->id,
            // ]);
        }

        $this->alert('success', 'Datos Actualizados!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);
        

        //redirect hacia home con mensaje de exito
        return redirect()->route('dashboard');
    }
}

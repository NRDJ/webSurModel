<?php

namespace App\Http\Livewire\Admin\Sponsor;

use Livewire\Component;
use App\Models\User\Sponsor;

use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SponsorCreate extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $image,$rut,$business_name,$main_line,$commercial_address,$logo,$contact_name,$contact_phone;
    public $identificador;

    public function mount(){
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.admin.sponsor.sponsor-create');
    }

    public function save(){

        $validateData = $this->validate([
            'rut' => ['required','unique:sponsors'],
            'business_name' => ['required'],
            'contact_name' => ['required'],
            'contact_phone' => ['required','numeric'],
            'logo' => ['nullable','image','max:1024'],
        ],        
        [
            'rut.required'=>"el campo rut es requerido",
            'rut.unique'=>"ya existe un campo con el este rut",
            'logo.image'=>"el campo debe ser una imagen",
            'logo.1024'=>"el tamaño de la imagen debe ser 1mb",
            'business_name.required'=>"el campo razon social es requerido",
            'contact_name.required'=>"el campo nombre de contacto es requerido",
            'contact_phone.required'=>"el campo numero de telefono es requerido",
            'contact_phone.numeric'=>"el campo numero de telefono debe ser numerico",
        ]);

        if($this->image!=null){
            $this->image->store('sponsors');
            $image = $this->image->hashName();
        }
        else{
            $image = "";
        }

        Sponsor::create([
            'rut' => $this->rut,
            'business_name' => $this->business_name,
            'main_line' => $this->main_line,
            'commercial_address' => $this->commercial_address,
            'logo' => $image,
            'contact_name' => $this->contact_name,
            'contact_phone'=> $this->contact_phone
        ]);

        $this->alert('success', 'Sponsor agregado!!', [
            'position' =>  'center', 
            'timer' =>  3000,  
            'toast' =>  false,
        ]);

        $this->reset('rut','business_name','main_line','commercial_address','logo','contact_name','contact_phone');
        $this->identificador = rand();
        $this->emitTo('admin.sponsor.sponsor-list', 'render');
    }
}

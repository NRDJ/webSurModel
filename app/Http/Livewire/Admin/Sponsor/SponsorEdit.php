<?php

namespace App\Http\Livewire\Admin\Sponsor;

use Livewire\Component;
use App\Models\User\Sponsor;

use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SponsorEdit extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $image, $sponsor, $identificador;


    //required|email|unique:users,email,'.$this->user->id,

    protected $rules = [
        'sponsor.rut' => '',
        'sponsor.business_name' => '',
        'sponsor.main_line' => '',
        'sponsor.commercial_address' => '',
        'sponsor.contact_name' => '',
        'sponsor.contact_phone' => '',
        'sponsor.logo' => '',
    ];

    public function mount(Sponsor $sponsor){
        $this->sponsor = Sponsor::find($sponsor->id);
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.admin.sponsor.sponsor-edit');
    }

    public function update(){

        $validateData = $this->validate([
            'sponsor.rut' => ['required','unique:sponsors,rut,'.$this->sponsor->id],
            'sponsor.business_name' => ['required'],
            'sponsor.contact_name' => ['required'],
            'sponsor.contact_phone' => ['required','numeric'],
            'image' => ['nullable','image','max:1024'],
        ],        
        [
            'sponsor.rut.required'=>"el campo rut es requerido",
            'sponsor.rut.unique'=>"ya existe un registro con el este rut",
            'image.image'=>"el archivo debe ser una imagen",
            'image.1024'=>"el tamaño de la imagen debe ser 1mb",
            'sponsor.business_name.required'=>"el campo razon social es requerido",
            'sponsor.contact_name.required'=>"el campo nombre de contacto es requerido",
            'sponsor.contact_phone.required'=>"el campo numero de telefono es requerido",
            'sponsor.contact_phone.numeric'=>"el campo numero de telefono debe ser numerico",
        ]);

        if($this->image!=null){
            $this->image->store('sponsors');
            $this->sponsor->logo = $this->image->hashName();
        }
        else{
            $this->sponsor->logo = $this->sponsor->logo;
        }

        $this->sponsor->save();

        $this->alert('success', 'Sponsor Actualizado!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            ]);

        $this->identificador = rand();
        $this->emitTo('admin.sponsor.sponsor-list', 'render');
    }
}

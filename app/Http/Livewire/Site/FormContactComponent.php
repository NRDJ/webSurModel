<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Mail\FormContact;
use Illuminate\Support\Facades\Mail;

class FormContactComponent extends Component
{
    use LivewireAlert;
    
    public $empresa, $nombre, $telefono, $correo, $mensaje;

    public function render()
    {
        return view('livewire.site.form-contact-component');
    }

    public function sendMessage()
    {
        $this->validate(
            [ 'empresa'=>'required', 'nombre'=>'required', 'telefono'=>'required', 'correo'=>'required|email', 'mensaje'=>'required|min:10'],            
            [
                'empresa.required'  => 'el nombre o la marca es requerida',
                'nombre.required'   => 'ingrese su nombre',
                'correo.required'   => 'se necesita un correo para contactarlo',
                'telefono.required' => 'se necesita un teléfono para contactarlo',
                'mensaje.required'  => 'ingrese su mensaje',
                'mensaje.min'       => 'mínimo 10 carácteres',
            ]
        );

        Mail::to(env('MAIL_TO_ADDRESS'))->send(new FormContact($this->empresa,$this->nombre,$this->correo,$this->telefono,$this->mensaje));
        $this->default();
        $this->alert('success', 'Mensaje enviado con éxito!', [
            'position' =>  'center', 
            'timer' =>  3000,  
            'toast' =>  false,
        ]);
    }

    public function default()
    {
        $this->empresa = '';
        $this->nombre = '';
        $this->correo = '';
        $this->telefono = '';
        $this->mensaje = '';

    }
}

<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateProfile extends Component
{
    use LivewireAlert;
    public $user,$current_password,$new_password,$new_confirm_password,$email,$new_email;

    protected $listeners = [
        'render',
    ];

    public function mount(User $user){
        $this->user = $user;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.settings.update-profile');
    }

    public function updatePassword(){

        $validateData = $this->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','min:8'],
            'new_confirm_password' => ['same:new_password'],
        ],        
        [
            'current_password.required' => 'El campo es requerido',
            'new_password.required' => 'El campo es requerido',
            'new_password.min' => 'Debe contener al menos 8 caracteres',
            'new_confirm_password.same' => 'Las contraseñas no coinciden',
        ]);

        User::find($this->user->id)->update(['password'=> Hash::make($this->new_password)]);    

        $this->reset('current_password','new_password','new_confirm_password');
        $this->alert('success', 'Contraseña actualizada!!', [
            'position' =>  'center', 
            'timer' =>  3000,  
            'toast' =>  false,
        ]);
    
    }

    public function updateEmail(){
        $n_email = $this->new_email;
        $validateData = $this->validate([
            'new_email' => ['required','email'],
        ],        
        [
            'new_email.required' => 'El campo es requerido',
            'new_email.email' => 'Debe ingresar un email valido',
        ]);

        User::find($this->user->id)->update(['email'=> $this->new_email]);    

        $this->reset('new_email');
        $this->email = $n_email;
        
        $this->alert('success', 'Correo actualizado!!', [
            'position' =>  'center', 
            'timer' =>  3000,  
            'toast' =>  false,
        ]);
    
    }

}

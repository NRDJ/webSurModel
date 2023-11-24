<?php

namespace App\Http\Livewire\Admin\Users\Photos;

use Livewire\Component;
use App\Models\User\Person;
use App\Models\User\Photo;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class SelectPhotos extends Component
{
    use LivewireAlert;

    public $photos,$values,$person;
    public $value;

    public function mount(Photo $photo, Person $person){
        $this->photo = $photo;
        // $this->values = $values;
        $this->person = $person;
        $this->value = $photo->confirmed;
    }

    public function render()
    {
        return view('livewire.admin.users.photos.select-photos');
    }

    // public function update(){
    public function update($id,$value){
        $picture = Photo::find($id);
        
        // $hola = "hola";
        if($value==0){
            $picture->update([
                'confirmed' => 1,
            ]);
        }
        else{
            $picture->update([
                'confirmed' => 0,
            ]);
        }
        
        $this->alert('success', 'Actualizado!', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
        ]);

        // $this->emit('render');
        $this->emitTo('admin.users.photos-index', 'render');
        // $this->redirectRoute('admin.users.photos', $this->person);
    }
}

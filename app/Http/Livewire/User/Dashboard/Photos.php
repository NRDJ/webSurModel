<?php

namespace App\Http\Livewire\User\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\User\Photo;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class Photos extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $user,$user_id;
    public $identificador,$images,$image;
    public $photo,$photos;

    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
    ];

    public function mount(User $user){
        $this->user = $user;
        $this->user_id = $this->user->id;
        $this->identificador = rand();
    }

    public function render()
    {   
        $this->photos = Photo::where('person_id',$this->user->person->id)->orderBy('created_at', 'DESC')->get();
        // $this->photos->refresh();
        return view('livewire.user.dashboard.photos',[
            // 'photos' => $photos,
        ]);
    }

    public function upload(){
        
        $this->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg|max:8192|required',
        ],
        [
            'images.*.image' => 'El archivo debe ser una imagen.',
            'images.*.mimes' => 'El archivo debe ser un tipo de archivo: jpeg, png, jpg.',
            'images.*.max' => 'El archivo no debe ser mayor que 8 megabytes.'
        ]);
        

        
        if(!empty($this->images)){
            foreach($this->images as $image){
                // dd($image->hashName());
                $image->store('photos/'.$this->user->id);
                $file = $image->hashName();
                Photo::create([
                    'photo_path' => $file,
                    'person_id' => $this->user->person->id,
                ]);
            }

            $this->alert('success', 'Imagen subida!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                ]);

        }
        else {
            $this->alert('error', 'No se ha cargado la imagen', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                ]);
        }

        $this->images=null;
        $this->identificador = rand();
    }

    public function delete($id){
        $this->photo = Photo::find($id);
        $this->confirm('Quieres elimnar la imagen?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);


        $this->emit('render');
        // return redirect()->route('photos');

    }

    public function confirmed()
    {
        
        $path = "photos/{$this->user->person->id}/{$this->photo->photo_path}";
        if(Storage::exists($path)){
            Storage::delete($path);
        }
        $this->photo->delete();
        
        $this->alert(
            'success',
            'Imagen Eliminada!'
        );

        $this->emit('render');
        // return redirect()->route('photos');
    }

    public function cancelled()
    {
        $this->alert('info', 'Cancelado');
        $this->emit('render');
        // return redirect()->route('photos');
    }
}

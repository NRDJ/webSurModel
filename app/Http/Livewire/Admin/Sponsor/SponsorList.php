<?php

namespace App\Http\Livewire\Admin\Sponsor;

use Livewire\Component;
use App\Models\User\Sponsor;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class SponsorList extends Component
{
    use LivewireAlert;

    public $sponsors;
    public $search;

    protected $listeners = [
        'render',
        'confirmed',
        'cancelled',
    ];

    public function render()
    {
        $this->sponsors = Sponsor::where('contact_name','like',"%{$this->search}%")->get();
        return view('livewire.admin.sponsor.sponsor-list');
    }

    public function delete($id){
        $this->sponsor = Sponsor::find($id);
        $this->confirm('Quieres elimnar el sponsor?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        $this->sponsor->delete();
        $this->alert('success', 'Sponsor Eliminado!', [
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

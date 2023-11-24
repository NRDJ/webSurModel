<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\User;
use App\Models\Person;

class Home extends Component
{
    public function render()
    {
        $last_events = Event::orderBy('updated_at', 'desc')->take(10)->get();
        $last_users = User::orderBy('created_at', 'desc')->take(10)->get();
        $cant_users = User::whereNot('role_id', 1)->count();
        $cant_users_whithout_info = User::whereDoesntHave('person')->whereNot('role_id', 1)->count();
        $cant_users_whith_info = User::whereHas('person')->whereNot('role_id', 1)->count();
        $cant_events_active = Event::where('state', 'Activo')->count();
        $cant_events_draft = Event::where('state', 'Borrador')->count();
        $cant_publications_active = Publication::where('state', 'Activo')->count();

        return view('livewire.admin.home',[
            'last_events' => $last_events,
            'cant_users' => $cant_users,
            'cant_users_whithout_info' => $cant_users_whithout_info,
            'cant_events_active' => $cant_events_active,
            'cant_publications_active' => $cant_publications_active,
            'cant_users_whith_info' => $cant_users_whith_info,
            'cant_events_draft' => $cant_events_draft,
            'last_users' => $last_users,
        ]);
    }
}


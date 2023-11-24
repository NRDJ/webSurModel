<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\Location\Region;
use App\Models\User\Person;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Storage;

class AdministrationController extends Controller
{

    public function __construct(){
        $this->middleware('auth',['except' => ['temporalAccess']]);
    }

    public function events(){
        $events = Event::all();
        $regions = Region::all(); 

        return view('dashboard.admin.events.index',compact('events','regions'));
    }

    public function publications($slug){
        $event = Event::where('slug',$slug)->first();
        // $publications = Publication::where('event_id',$event->id)->get();
        return view('dashboard.admin.events.publications.index',compact('event'));
    }

    public function publication_detail($slug, $id){
        $publication = Publication::find($id);
        return view('dashboard.admin.events.publications.detail',compact('publication'));
    }

    public function sponsors(){
        return view('dashboard.admin.sponsors.index');
    }
    public function profiles(){
        return view('dashboard.admin.profiles.index');
    }
    public function users(){
        // $users = User::all();
        return view('dashboard.admin.users.index');
    }

    public function invoice($slug,  Publication $publication, Person $person,){
        $pr = \App\Models\User\PersonRequest::where('person_id',$person->id)->where('publication_id',$publication->id)->first();
        $payment = \App\Models\Payment\Payment::where('person_request_id',$pr->id)->first();
        return view('dashboard.admin.events.payment.invoice',compact('person','publication','payment'));
    }

    public function photosUser(Person $person){
        return view('dashboard.admin.users.photos.index',compact('person'));
    }

    public function settingsUser(User $user){
        return view('dashboard.admin.users.settings.user',compact('user'));
    }

    // public function generarPDF($slug, $id){
    //     $publication = Publication::find($id);

    //     $people = Person::join('person_requests','person_requests.person_id','=','people.id')
    //                         // ->whereIn('people.id',$this->values)
    //                         ->where('person_requests.publication_id',$publication->id)
    //                         ->where('person_requests.state','Preseleccionado')
    //                         ->select('people.*')
    //                         ->get();;

    //     $pdf = PDF::loadView('pdf.prueba', ['publication'=>$publication, 'people'=>$people]);
    //     return $pdf->download('document.pdf');

    //     return view('pdf.prueba',compact('publication','people'));
    // }
    
    public function temporalAccess(Request $request,$slug,$id){
        if (! $request->hasValidSignature()) {
            abort(403);
        }
        $publication = Publication::find($id);
        return view('casting_temporal.index',compact('publication'));
    }

}

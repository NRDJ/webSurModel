<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event\Publication;
use App\Models\User\Person;
use App\Models\Payment\Payment;

class MainPageController extends Controller
{
    public function personalInformation(){
        return view('dashboard.user.personalInformation');
    }

    public function photos(){
        return view('dashboard.user.photos');
    }

    public function applications(){
        return view('dashboard.user.applications');
    }

    public function history(){
        return view('dashboard.user.history');
    }

    public function confirmarEvento(Request $request,Publication $publication,Person $person){
    
        // return "hacer logica de confirmación ".$publication->event->name." ".$person->name;

        if (! $request->hasValidSignature()) {
                abort(403);
        }
        return view('notifications.user-selected', compact('publication','person'));

        // if ($person->person_request()->where('publication_id',$publication->id)->first()->pivot->estado == "Seleccionado") {
        //     $person->person_request()->updateExistingPivot($publication->id,['estado'=>'Confirmado'],false);
        //     $message = "Confirmación exitosa";
        //     return view('response_email.confirmation_event',compact('message'));
        // } elseif($person->person_request()->where('publication_id',$publication->id)->first()->pivot->estado == "Confirmado") {
        //     $message = "Ya se ha confirmado asistencia al evento ".$publication->evento->nombre;
        //     return view('response_email.confirmation_event',compact('message'));
        // }
        // else{
        //     abort(404, 'File not found!');
        // }
        
    }

    public function confirmarDiasPago(Request $request,Publication $publication,Person $person){
    
        // return "hacer logica de confirmación ".$publication->event->name." ".$person->name;

        if (! $request->hasValidSignature()) {
                abort(403);
        }
        return view('notifications.days-payment', compact('publication','person'));

        // if ($person->person_request()->where('publication_id',$publication->id)->first()->pivot->estado == "Seleccionado") {
        //     $person->person_request()->updateExistingPivot($publication->id,['estado'=>'Confirmado'],false);
        //     $message = "Confirmación exitosa";
        //     return view('response_email.confirmation_event',compact('message'));
        // } elseif($person->person_request()->where('publication_id',$publication->id)->first()->pivot->estado == "Confirmado") {
        //     $message = "Ya se ha confirmado asistencia al evento ".$publication->evento->nombre;
        //     return view('response_email.confirmation_event',compact('message'));
        // }
        // else{
        //     abort(404, 'File not found!');
        // }
    }

    public function verComprobante(Request $request,Publication $publication,Person $person, Payment $payment){
        return view('notifications.user-voucher', compact('publication','person','payment'));
    }
}

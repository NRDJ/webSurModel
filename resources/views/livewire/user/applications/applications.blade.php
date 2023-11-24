<div>
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach ($publications as $publication)
        <div class="card card_column card_hoverable">
            <div class="image">
                <div class="aspect-w-4 aspect-h-3">
                @if ($publication->event->path_image)
                    <img src="{{ route('event.image',['image'=>$publication->event->path_image]) }}">
                @elseif($publication->event->sponsor->logo)
                    <img src="{{ route('sponsor.image',['image'=>$publication->event->sponsor->logo]) }}">
                @else
                    <img src="{{ asset('img/no-image.jpg') }}">
                @endif
                </div>
                <div
                    class="badge badge_outlined badge_info uppercase absolute top-0 ltr:right-0 rtl:left-0 mt-2 ltr:mr-2 rtl:ml-2">
                    {{ $publication->profile->name }}</div>
            </div>
            <div class="header">
                <!-- nombre -->
                <h5>{{ $publication->event->name }}</h5>
            </div>
            <div class="body">
                <h6 class="uppercase mt-2">Cliente</h6>
                <p>{{ $publication->event->sponsor->contact_name }}</p>
                <h6 class="uppercase mt-2">Ubicación</h6>
                <p>Comuna {{ $publication->event->city->name }}, Región {{ $publication->event->city->region->name }} </p>
                <div class="grid grid-cols-2 gap-2">
                    <div class="">
                        <h6 class="uppercase mt-2">Fecha</h6>
                        @if ($publication->date)
                            <p>{{ $publication->getDate() }}</p>
                        @else
                            <p>{{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }} </p>
                        @endif
                    </div>
                    <div>
                        <h6 class="uppercase mt-2">Horario</h6>
                        @if ($publication->start_time && $publication->time_end)
                            <p>{{ $publication->getStartTime() }} a {{ $publication->getTimeEnd() }} </p>
                        @else
                            <p>{{ $publication->event->getStartTime() }} a {{ $publication->event->getTimeEnd() }} </p>
                        @endif
                    </div>
                </div>
                <h6 class="uppercase mt-2">Cantidad</h6>
                <p>{{ $publication->amount }}</p>
                <h6 class="uppercase mt-2">Remuneración</h6>
                <p>${{ $publication->remuneration }}</p>
                <h6 class="uppercase mt-2">Colación</h6>
                <p>{{ $publication->collation }}</p>
            </div>
            <div class="actions">
                @if (Auth::user()->person->person_request()->where('publication_id',$publication->id)->first()->pivot->state == "Seleccionado")
                    {{-- <button  class="btn btn_primary"> --}}
                        <a href="{{ URL::signedRoute('confirm-event',['publication'=> $publication,'person' => Auth::user()->person ]) }}" class="btn btn_primary">Dar respuesta</a>
                    {{-- </button> --}}
                @endif
            
                @php
                    $pr= \App\Models\User\PersonRequest::where('person_id',Auth::user()->person->id)->where('publication_id',$publication->id)->first();
                    $payment = \App\Models\Payment\Payment::where('person_request_id',$pr->id)->first();
                @endphp
                @if ( !$payment && Auth::user()->person->person_request()->where('publication_id',$publication->id)->first()->pivot->state == "Confirmado")
                    {{-- <button class="btn btn_primary uppercase"> --}}
                        <a href="{{ URL::signedRoute('days-payment',['publication'=> $publication,'person' => Auth::user()->person ]) }}" class="btn btn_primary">Subir boleta</a>
                    {{-- </button> --}}
                @endif
                @if ($payment)
                    <a href="{{ URL::signedRoute('user-voucher',['publication'=> $publication,'person' => Auth::user()->person, 'payment'=>$payment ]) }}" class="btn btn_info">Ver Comprobante</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>



</div>



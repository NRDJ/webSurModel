@component('mail::message')
# Hola {{ $person->name }} {{ $person->last_name }}

Has sido seleccionado para participar en el evento
## {{ $publication->event->name }}

Este evento tiene el siguiente detalle

@component('mail::table')
| Detalle       | {{ $publication->event->name }}         |
| :--------- | :------------- |
| Ubicacion | {{ $publication->event->city->region->name }}, {{ $publication->event->city->name }} |
| Fecha      | @if ($publication->date) {{ $publication->getDate() }} @else {{ $publication->event->getStartDate() }} al {{ $publication->event->getStartTime() }} @endif | 
| Horario    | @if ($publication->start_time && $publication->time_end ) {{ $publication->getStartTime() }} A {{ $publication->getTimeEnd() }} @else {{ $publication->event->getStartTime() }} - {{ $publication->event->getTimeEnd() }} @endif | 
| Colacion   | {{ $publication->collation }} |
| Pago    | {{ $publication->remuneration }} |
@endcomponent


@component('mail::button', ['url' => URL::signedRoute('confirm-event',['publication'=> $publication,'person' => $person,])])
Haga click para confirmar
@endcomponent


#### _enviado por ASD Informáticos_
@endcomponent

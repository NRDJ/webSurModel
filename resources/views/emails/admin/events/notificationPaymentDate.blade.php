@component('mail::message')
# Hola {{ $person->name }} {{ $person->last_name }}

Debes establecer la fecha que quieres recibir el pago del evento {{ $publication->event->name }} en el siguiente link

@component('mail::button', ['url' => URL::signedRoute('days-payment',['publication'=> $publication,'person' => $person ]) ])
Establecer fecha de pago
@endcomponent

Detalle del evento

@component('mail::table')
| Detalle       | {{ $publication->event->name }}         |
| :--------- | :------------- |
| Ubicacion | {{ $publication->event->city->region->name }}, {{ $publication->event->city->name }} |
| Fecha      | @if ($publication->date) {{ $publication->getDate() }} @else {{ $publication->evento->getStartDate() }} al {{ $publication->evento->getStartTime() }} @endif | 
| Horario    | @if ($publication->start_time && $publication->time_end ) {{ $publication->getStartTime() }} A {{ $publication->getTimeEnd() }} @else {{ $publication->event->getStartTime() }} - {{ $publication->event->getTimeEnd() }} @endif | 
| Colacion   | {{ $publication->collation }} |
| Pago    | {{ $publication->remuneration }} |
@endcomponent

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Gracias,<br>
{{ config('app.name') }}
@endcomponent

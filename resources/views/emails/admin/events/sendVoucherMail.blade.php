@component('mail::message')
# Comprobante de pago

Hola {{ $person->name }} {{ $person->last_name }}
se adjunta comprobante de pago correspondiente al evento {{ $publication->event->name }} en el que participaste como {{ $publication->profile->name }}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

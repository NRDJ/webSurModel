@component('mail::message')
# Mensaje enviado por {{ $nombre }}, representando a {{ $empresa }}

## Formas de contactarme
### correo : {{ $correo }}
### teléfono : {{ $telefono }}

## Mensaje
### {{ $mensaje }}

Gracias,<br>
{{ $nombre }}
@endcomponent

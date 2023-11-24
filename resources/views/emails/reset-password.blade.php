@component('mail::message')
# Hola {{ $user->name }} has solicitado un enlace para cambiar tu contraseña

@component('mail::button', ['url' => URL::temporarySignedRoute('reset.password.get',now()->addMinute(5),['token'=>$token]) ])
{{-- @component('mail::button', ['url' => URL::signedRoute('confirm-event',['publication'=> $publication,'person' => $person,])]) --}}
Haga click para cambiar la contraseña
@endcomponent


#### _enviado por ASD Informáticos_
@endcomponent

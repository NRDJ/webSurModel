<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormContact extends Mailable
{
    use Queueable, SerializesModels;

    protected $empresa, $nombre, $correo, $telefono, $mensaje;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empresa,$nombre,$correo,$telefono,$mensaje)
    {
        $this->empresa = $empresa;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->correo)
                    ->subject('Formulario de contacto Sur Model')
                    ->markdown('mails.form.contacto')
                    ->with([
                        'empresa'   => $this->empresa,
                        'nombre'    => $this->nombre,
                        'correo'    => $this->correo,
                        'telefono'  => $this->telefono,
                        'mensaje'   => $this->mensaje,
                    ]);
    }
}

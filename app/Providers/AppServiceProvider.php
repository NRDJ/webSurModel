<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::$toMailCallback = function($notifiable, $verificationUrl)
        {
            return (new MailMessage)
                    ->subject('Confirme su correo electrónico')
                    ->line('Por favor, haga clic en el botón de abajo para verificar su correo electrónico.')
                    ->action('Confirme su correo electrónico', $verificationUrl)
                    ->line('Si no creó una cuenta, no se requiere ninguna otra acción.');
        };
    }
}

@extends('layouts.yeti.background')

@section('content')
<section class="top-bar">
    <span class="brand">SM</span>

    <nav class="flex items-center ltr:ml-auto rtl:mr-auto">

        <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
            <input id="darkModeToggler" type="checkbox">
            <span></span>
        </label>
        <button id="fullScreenToggler" type="button"
                class="hidden lg:inline-block btn-link ltr:ml-5 rtl:mr-5 text-2xl leading-none la la-expand-arrows-alt"
                data-toggle="tooltip" data-tippy-content="Fullscreen">
        </button>
    </nav>
</section>

<div class="container flex items-center justify-center mt-20 py-10">
    <div class="w-full md:w-1/2 xl:w-1/3">
        <div class="mt-3">
            <h3>
                Bienvenido a Sur Model
            </h3>
            <h4>
                Antes de comenzar ¿verifica tu correo haciendo clic en el enlace que te acabamos de enviar? <br>
                Si no lo recibiste, con gusto te enviaremos otro.
            </h4>
        </div>
        @if (session('status') == 'verification-link-sent')
            <div class="mt-3">
                <h5>
                    Se ha enviado un nuevo enlace de verificación al correo electrónico que proporcionó durante el registro.
                </h5>
            </div>
        @endif

        <div class="card mt-5 p-5 md:p-10">

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <button type="submit" class="btn btn_primary uppercase">
                        Reenviar verificación
                    </button>
                </div>
            </form>

            <div class="mt-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn_outlined btn_secondary uppercase">
                        Volver
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection


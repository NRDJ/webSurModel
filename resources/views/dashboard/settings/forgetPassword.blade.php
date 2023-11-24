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
                Resetear Contraseña
            </h3>
            <h4>
                <br>
            </h4>
        </div>

        <div class="card mt-5 p-5 md:p-10">

            @if (Session::has('message'))
            <div class="alert alert_success">
                <strong class="uppercase"><bdi>Success!</bdi></strong>
                {{ Session::get('message') }}
                <button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
            </div>
            @endif

            <form action="{{ route('forget.password.post') }}" method="POST">

                @csrf

                <div class="relative mt-5">
                    <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="email">E-Mail</label>
                    <input type="email" id="email" name="email" autofocus required class="form-control mt-2 pt-5" placeholder="Correo Electronico">
                    @if ($errors->has('email'))
                    <small class="block mt-2 invalid-feedback">{{ $errors->first('email') }}</small>
                    @endif

                </div>

                <div class="col-md-6 offset-md-4 mt-3">
                    <button type="submit" class="btn btn_primary uppercase">
                        Enviar link para cambiar contraseña
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection

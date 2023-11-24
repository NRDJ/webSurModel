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
            <div class="alert alert-success" role="alert">
               {{ Session::get('message') }}
            </div>
            @endif

            <form action="{{ route('reset.password.post') }}" method="POST">

                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="relative mt-5">
                    <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="email">E-Mail</label>
                    <input type="email" id="email" name="email" autofocus required class="form-control mt-2 pt-5" placeholder="Correo Electronico">
                    @if ($errors->has('email'))
                    <small class="block mt-2 invalid-feedback">{{ $errors->first('email') }}</small>
                    @endif
                </div>

                <div class="relative mt-5">
                    <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required class="form-control mt-2 pt-5" >
                    @if ($errors->has('password'))
                    <small class="block mt-2 invalid-feedback">{{ $errors->first('password') }}</small>
                    @endif
                </div>

                <div class="relative mt-5">
                    <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control mt-2 pt-5">
                    @if ($errors->has('password_confirmation'))
                    <small class="block mt-2 invalid-feedback">{{ $errors->first('password_confirmation') }}</small>
                    @endif
                </div>

                <div class="col-md-6 offset-md-4 mt-3">
                    <button type="submit" class="btn btn_primary uppercase">
                        Establecer nueva contraseña
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection

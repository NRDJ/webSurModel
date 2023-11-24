@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')
    {{-- @include('layouts.yeti.customizer') <!--cambiar color --> --}}

    <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Home</h1>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li><a href="#">Eventos</a></li>
                </ul>
            </div>
        </section>

        <!-- List -->
        @if (Auth::user()->person)
            @if (count(Auth::user()->person->photos)==0)
            <div class="grid lg:grid-cols-3">
                <a href="{{ route('photos') }}" class="btn btn_primary uppercase">Subir Fotos</a>
            </div>
            @else
                @livewire('user.home', ['user' => Auth::user()])
            @endif
        @else
        <div class="grid lg:grid-cols-3">
            <a href="{{ route('personal-information') }}" class="btn btn_primary uppercase">Completar información personal</a>
        </div>
        @endif

        <div class="mt-5">
            {{-- @@include("partials/_pagination.html") --}}
        </div>

        @include('layouts.yeti.footer')

    </main>


@endsection
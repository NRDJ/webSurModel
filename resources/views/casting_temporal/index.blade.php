@extends('layouts.yeti.background')

@section('content')
    {{-- @include('layouts.yeti.navigation') --}}
    {{-- @include('layouts.yeti.customizer') <!--cambiar color --> --}}

    <section class="top-bar">
        <span class="brand">{{ config('app.name') }}</span>
    
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

    <!-- Workspace -->
    <main class="workspace">
        
        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Casting {{ $publication->profile->name }}</h1>
                <h2>Evento {{ $publication->event->name }}</h2>
            </div>
        </section>

        @livewire('casting.lists',['publication' => $publication])

        @include('layouts.yeti.footer')

    </main>

@endsection

@section('js')
    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
@endsection
@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')
    {{-- @include('layouts.yeti.customizer') <!--cambiar color --> --}}

    <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Actualizar Datos</h1>
            </div>
        </section>

        <!-- List -->
        @livewire('settings.update-profile', ['user' => Auth::user()])

        <div class="mt-5">
            
        </div>

        @include('layouts.yeti.footer')

    </main>


@endsection
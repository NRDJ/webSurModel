@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')
    {{-- @include('layouts.yeti.customizer') <!--cambiar color --> --}}

    <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Historial de Postulaciones</h1>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>Hisotial de Eventos</li>
                </ul>
            </div>
        </section>

        <!-- List -->
        @livewire('user.applications.applications', ['user' => Auth::user()])

        <div class="mt-5">
            {{-- @@include("partials/_pagination.html") --}}
        </div>

        @include('layouts.yeti.footer')

    </main>


@endsection
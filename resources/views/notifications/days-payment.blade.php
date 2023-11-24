@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')
    {{-- @include('layouts.yeti.customizer') <!--cambiar color --> --}}

    <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Pago</h1>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li><a href="#">Evento</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>{{ $publication->event->name }} - {{ $publication->profile->name }}</li>
                </ul>
            </div>
        </section>

        <!-- List -->
        @livewire('notifications.days-payment', ['publication'=>$publication,'user' => Auth::user()])

        <div class="mt-5">
            
        </div>

        @include('layouts.yeti.footer')

    </main>


@endsection
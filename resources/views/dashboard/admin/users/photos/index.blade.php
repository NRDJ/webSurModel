@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace overflow-hidden">

            <!-- Breadcrumb -->
            <section class="breadcrumb">
                <h1>{{ $person->name }}  {{ $person->last_name }}</h1>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li><a href="#">Usuarios</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>Fotos</li>
                </ul>
            </section>
    
            @livewire('admin.users.photos', ['person' => $person])
            
            <div class="mt-5">
                <a href="{{ URL::previous() }}" class="btn btn_info uppercase">Volver Atrás</a>
            </div>

            @include('layouts.yeti.footer')
    
        </main>

@endsection
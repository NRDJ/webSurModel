@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace">

            <!-- Breadcrumb -->
            <section class="breadcrumb">
                <h1>Usuarios</h1>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>Usuarios</li>
                    <li class="divider la la-arrow-right"></li>
                    <li>{{ $user->email }}</li>
                </ul>

            </section>
            
            @livewire('admin.users.settings.assign-event', ['user' => $user])

            @include('layouts.yeti.footer')
    
        </main>
@endsection
@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace">

            <!-- Breadcrumb -->
            <section class="breadcrumb">
                <h1>Información Personal</h1>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>Información Personal</li>
                </ul>

                @livewire('user.dashboard.personal-information',['user' => Auth::user()])
            </section>
    
            @include('layouts.yeti.footer')
    
        </main>
@endsection
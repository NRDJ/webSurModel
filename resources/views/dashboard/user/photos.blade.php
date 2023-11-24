@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

    <!-- Workspace -->
    <main class="workspace overflow-hidden">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Fotos</h1>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>Fotos</li>
                </ul>
            </div>

        </section>
            
            {{-- @livewire('user.dashboard.photos.dropzone') --}}

        @livewire('user.dashboard.photos', ['user' => Auth::user()])
            
        @include('layouts.yeti.footer')

    </main>


@endsection
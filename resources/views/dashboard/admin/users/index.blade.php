@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace">
            
            @livewire('admin.users.users-list')

            @include('layouts.yeti.footer')
    
        </main>
@endsection
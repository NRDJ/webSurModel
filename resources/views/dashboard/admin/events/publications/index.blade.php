@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace">

            <!-- Breadcrumb -->
            <section class="breadcrumb lg:flex items-start">
                <div>
                    <h1>Publicaciones</h1>
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">{{ $event->name }}</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">Publicaciones</a></li>
                    </ul>
                </div>
    
                <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">

                    @livewire('admin.events.event.publications-create',['event' => $event])
                </div>
            </section>

            @livewire('admin.events.event.publications-list',['event' => $event])
    
            @include('layouts.yeti.footer')
    
        </main>
@endsection
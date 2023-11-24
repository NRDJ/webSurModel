@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace">

            <!-- Breadcrumb -->
            <section class="breadcrumb lg:flex items-start">
                <div>
                    <h1>Sponsor</h1>
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">sponsors</a></li>
                    </ul>
                </div>
    
                <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
    
                    @livewire('admin.sponsor.sponsor-create')
                </div>
            </section>

            @livewire('admin.sponsor.sponsor-list')
    
            @include('layouts.yeti.footer')
    
        </main>
@endsection
@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace">

            <!-- Breadcrumb -->
            <section class="breadcrumb lg:flex items-start">
                <div>
                    <h1>Perfiles</h1>
                    <ul>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="{{ route('admin.profiles') }}">Perfiles</a></li>
                    </ul>
                </div>
    
                <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
    
                    {{-- <!-- Search -->
                    <form class="flex flex-auto items-center" action="#">
                        <label class="form-control-addon-within rounded-full">
                            <input type="text" class="form-control border-none" placeholder="Search">
                            <button type="button"
                                class="btn btn-link text-gray-300 dark:text-gray-700 dark:hover:text-primary text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                        </label>
                    </form> --}}

                    @livewire('admin.profile.profile-create')
                </div>
            </section>

            @livewire('admin.profile.profile-list')
    
            @include('layouts.yeti.footer')
    
        </main>
@endsection
@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace">

            <!-- Breadcrumb -->
            <section class="breadcrumb lg:flex items-start">
                <div>
                    <h1>{{ $publication->profile->name }}</h1>
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">{{ $publication->event->name }}</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">Publicaciones</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">{{ $publication->profile->name }}</a></li>
                    </ul>
                </div>
    
                <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
    
                    <!-- Layout -->
                    {{-- <div class="flex gap-x-2">
                        <a href="blog-list.html" class="btn btn-icon btn-icon_large btn_outlined btn_secondary">
                            <span class="la la-bars"></span>
                        </a>
                        <a href="blog-list-card-rows.html" class="btn btn-icon btn-icon_large btn_outlined btn_secondary">
                            <span class="la la-list"></span>
                        </a>
                        <a href="#" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
                            <span class="la la-th-large"></span>
                        </a>
                    </div> --}}
    
                    <!-- Search -->
                    {{-- busqueda --}}
                    <form class="flex flex-auto items-center" action="#">
                        <label class="form-control-addon-within rounded-full">
                            <input type="text" class="form-control border-none" placeholder="Search">
                            <button type="button"
                                class="btn btn-link text-gray-300 dark:text-gray-700 dark:hover:text-primary text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                        </label>
                    </form>
    
                    {{-- <div class="flex gap-x-2">
                        <button class="btn btn_primary uppercase">Add New</button>
                    </div> --}}
                    
                    {{-- @livewire('admin.events.event.publications-create',['event' => $event]) --}}
                </div>
            </section>

            {{-- <!-- detalle -->
            <div class="flex justify-center gap-2">
                
                <div class="card p-5">
                    <h3>{{ $publication->profile->name }} para {{ $publication->event->name }}</h3>
                    <div class="grid lg:grid-cols-2 mt-3">
                        <h5>Ubicación</h5>
                        <p>Región {{ $publication->event->city->region->name }}, Comuna {{$publication->event->city->name }}</p>
                    </div>
                    <div class="grid lg:grid-cols-2">
                        <h5>Cantidad de días del evento</h5>
                        <p>{{ $publication->event->number_days }}</p>
                    </div>
                    <div class="grid lg:grid-cols-2">
                        <h5>Sponsor</h5>
                        <p>{{ $publication->event->sponsor->contact_name }}</p>
                    </div>
                    <div class="grid lg:grid-cols-2">
                        <h5>Remuneración</h5>
                        <p>${{ $publication->remuneration }}</p>
                    </div>
                    <div class="grid lg:grid-cols-2">
                        <h5>Cantidad de personas requeridas</h5>
                        <p>{{ $publication->amount }}</p>
                    </div>
                    <div class="grid lg:grid-cols-2">
                        <h5>Colación</h5>
                        <p>{{ $publication->collation }}</p>
                    </div>
                    <div class="grid lg:grid-cols-2">
                        <h5>Fecha</h5>
                        @if ($publication->date )
                            <p>{{ $publication->getDate() }}</p>    
                        @else
                            <p>{{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }}</p>
                        @endif
                    </div>
                    <div class="grid lg:grid-cols-2">
                        <h5>Horario</h5>
                        @if ($publication->start_time && $publication->time_end )
                        <p>{{ $publication->event->getStartTime() }} a {{ $publication->event->getTimeEnd() }}</p>
                        @else
                            <p>{{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }}</p>
                        @endif
                    </div>
                </div>

                <div class="card p-5">
                    <h3>Filtros</h3>
                    <div class="flex gap-2">
                        <div>
                            <h4>Custom Select</h4>
                            <form class="mt-5">
                                <div class="custom-select">
                                    <select class="form-control">
                                        <option>Select</option>
                                        <option>Option</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <h4>Custom Select</h4>
                            <form class="mt-5">
                                <div class="custom-select">
                                    <select class="form-control">
                                        <option>Select</option>
                                        <option>Option</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <h4>Custom Select</h4>
                            <form class="mt-5">
                                <div class="custom-select">
                                    <select class="form-control">
                                        <option>Select</option>
                                        <option>Option</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <h4>Custom Select</h4>
                            <form class="mt-5">
                                <div class="custom-select">
                                    <select class="form-control">
                                        <option>Select</option>
                                        <option>Option</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            @livewire('admin.events.event.publication-detail',['publication' => $publication])
    
            @include('layouts.yeti.footer')
    
        </main>
@endsection
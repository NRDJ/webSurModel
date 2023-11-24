@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')
    {{-- @include('layouts.yeti.customizer') <!--cambiar color --> --}}

    <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Dashboard Admin</h1>
            </div>

        </section>

        @livewire('admin.home')

        {{-- <div class="grid lg:grid-cols-2 gap-5">

            <!-- Summaries -->
            <div class="grid sm:grid-cols-3 gap-5">
                <div
                    class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-sun"></span>
                        <p class="mt-2">Total Usuarios</p>
                        <div class="text-primary mt-5 text-3xl leading-none">18</div>
                    </div>
                </div>
                <div
                    class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-cloud"></span>
                        <p class="mt-2">Usuarios sin info completa</p>
                        <div class="text-primary mt-5 text-3xl leading-none">16</div>
                    </div>
                </div>
                <div
                    class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-layer-group"></span>
                        <p class="mt-2">Eventos Activos</p>
                        <div class="text-primary mt-5 text-3xl leading-none">9</div>
                    </div>
                </div>
            </div>

            <!-- Lines -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                <div class="card p-5">
                    <h6 class="chart-heading uppercase"></h6>
                    <h4 class="chart-value text-2xl mt-2"></h4>
                    <small class="chart-label uppercase"></small>
                    <canvas id="lineWithAnnotationChart1" class="mt-5"></canvas>
                </div>
                <div class="card p-5">
                    <h6 class="chart-heading uppercase"></h6>
                    <h4 class="chart-value text-2xl mt-2"></h4>
                    <small class="chart-label uppercase"></small>
                    <canvas id="lineWithAnnotationChart2" class="mt-5"></canvas>
                </div>
                <div class="card p-5">
                    <h6 class="chart-heading uppercase"></h6>
                    <h4 class="chart-value text-2xl mt-2"></h4>
                    <small class="chart-label uppercase"></small>
                    <canvas id="lineWithAnnotationChart3" class="mt-5"></canvas>
                </div>
                <div class="card p-5">
                    <h6 class="chart-heading uppercase"></h6>
                    <h4 class="chart-value text-2xl mt-2"></h4>
                    <small class="chart-label uppercase"></small>
                    <canvas id="lineWithAnnotationChart4" class="mt-5"></canvas>
                </div>
            </div>

            <!-- Visitors -->
            <div class="card p-5 min-w-0">
                <h3>Visitors</h3>
                <div class="mt-5 min-w-0">
                    <canvas id="visitorsChart"></canvas>
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="card p-5 flex flex-col">
                <h3>Ultimas Actualizaciones</h3>
                <table class="table table_list mt-3 w-full">
                    <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right uppercase">Nombre</th>
                            <th class="w-px uppercase">Fecha inicio</th>
                            <th class="w-px uppercase">Fecha termino</th>
                            <th class="w-px uppercase">Postulaciones</th>
                            <th class="w-px uppercase">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($last_events as $last_event)
                        <tr>
                            <td>{{ $last_event->name }}</td>
                            <td>{{ $last_event->getStartDate() }}</td>
                            <td>{{ $last_event->getDateEnd() }}</td>
                            <td class="text-center">
                                {{ $last_event-> }}

                            </td>
                            <td class="text-center">
                                @if ($last_event->state == 'Activo')
                                <div class="badge badge_outlined badge_success uppercase">{{ $last_event->state }}</div>
                                @elseif ($last_event->state == 'Borrador')
                                <div class="badge badge_outlined badge_warning uppercase">{{ $last_event->state }}</div>
                                @elseif ($last_event->state == 'Cancelado')
                                <div class="badge badge_outlined badge_danger uppercase">{{ $last_event->state }}</div>
                                @elseif ($last_event->state == 'Finalizado')
                                <div class="badge badge_outlined badge_primary uppercase">{{ $last_event->state }}</div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-auto">
                    <a href="{{ route('admin.events') }}" class="btn btn_primary mt-5">Ver todos los eventos</a>
                </div>
            </div>

            <!-- Categories -->
            <div class="card p-5 flex flex-col min-w-0">
                <h3>Categories</h3>
                <div class="flex-auto mt-5 min-w-0">
                    <canvas id="categoriesChart"></canvas>
                </div>
            </div>

            <!-- Quick Post -->
            <div class="card p-5">
                <h3>Quick Post</h3>
                <div class="mt-5">
                    <form>
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Title</label>
                            <input id="title" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="content">Content</label>
                            <textarea id="content" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="category">Category</label>
                            <div class="custom-select">
                                <select class="form-control">
                                    <option>Select</option>
                                    <option>Option</option>
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="btn btn_primary uppercase">Publish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        @include('layouts.yeti.footer')

    </main>


@endsection
<!-- Top Bar -->
<header class="top-bar">

    <!-- Menu Toggler -->
    <button type="button" class="menu-toggler la la-bars" data-toggle="menu"></button>

    <!-- Brand -->
    <span class="brand">{{config('app.name')}}</span>

    <!-- Right -->
    <div class="flex items-center ltr:ml-auto rtl:mr-auto">

        <!-- Dark Mode -->
        <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
            <input id="darkModeToggler" type="checkbox">
            <span></span>
        </label>

        <!-- Notifications -->
        @if (Auth::user()->role->key == 'user')
            <div class="dropdown self-stretch">
                <button type="button"
                    class="relative flex items-center h-full btn-link ltr:ml-1 rtl:mr-1 px-2 text-2xl leading-none la la-bell"
                    data-toggle="custom-dropdown-menu" data-tippy-arrow="true" data-tippy-placement="bottom-end">
                    <span
                        class="absolute top-0 right-0 rounded-full border border-primary -mt-1 -mr-1 px-2 leading-tight text-xs font-body text-primary">
                        @if (Auth::user()->person)
                            {{ count(Auth::user()->person->person_request()->where('person_requests.state',"Seleccionado")->get() )}}
                        @endif
                    </span>
                </button>
                <div class="custom-dropdown-menu">
                    {{-- <div class="flex items-center px-5 py-2">
                        <h5 class="mb-0 uppercase">Notifications</h5>
                        <button class="btn btn_outlined btn_warning uppercase ltr:ml-auto rtl:mr-auto">Clear All</button>
                    </div>
                    <hr> --}}
                    @if (Auth::user()->person)
                        @foreach (Auth::user()->person->person_request()->where('person_requests.state',"Seleccionado")->get() as $publication)
                            <div class="p-5 hover:bg-primary hover:bg-opacity-5">
                                <a href="{{ URL::signedRoute('confirm-event',['publication'=> $publication,'person' => Auth::user()->person ]) }}">
                                    <h6 class="uppercase">Has sido seleccionado</h6>
                                </a>
                                <p>{{$publication->event->name}}</p>
                                <small>
                                    <p>Fecha
                                    @if ($publication->date)
                                        {{ $publication->getDate() }}
                                    @else
                                        {{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }}
                                    @endif
                                    </p>
                                </small>
                                <small>
                                    <p>Horario
                                    @if ($publication->start_time && $publication->time_end)
                                        {{ $publication->getStartTime() }} a {{ $publication->getTimeEnd() }}
                                    @else
                                        {{ $publication->event->getStartTime() }} a {{ $publication->event->getTimeEnd() }}
                                    @endif
                                    </p>
                                </small>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif

        <!-- User Menu -->
        <div class="dropdown">
            <button class="flex items-center ltr:ml-4 rtl:mr-4" data-toggle="custom-dropdown-menu"
                data-tippy-arrow="true" data-tippy-placement="bottom-end">
                @if (Auth::user()->person)
                <span class="avatar uppercase">{{ (substr(Auth::user()->person->name,0,1)) }}{{ substr(Auth::user()->person->last_name,0,1) }}</span>    
                @else
                <span class="avatar uppercase">{{ substr(Auth::user()->name,0,1) }}</span>
                @endif
            </button>
            <div class="custom-dropdown-menu w-64">
                <div class="p-5">
                    @if (Auth::user()->person)
                    <h5 class="uppercase">{{ Auth::user()->person->name }} {{ Auth::user()->person->last_name }}</h5>    
                    @else
                    <h5 class="uppercase">{{ Auth::user()->name }}</h5>
                    @endif
                    <p>{{ Auth::user()->role->name }}</p>
                </div>
                <hr>
                <div class="p-5">
                    <a href="{{ route('changePassword') }}" class="flex items-center text-normal hover:text-primary">
                        <span class="la la-user-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                        Actualizar Perfil
                    </a>
                </div>
                <hr>
                <div class="p-5">
                    <!-- Authentication -->
                    <form id="frm-logout" method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" class="flex items-center text-normal hover:text-primary" onclick="event.preventDefault();document.getElementById('frm-logout').submit();">
                            <span class="la la-power-off text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                            Cerrar Sesión
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Menu Bar -->
<aside class="menu-bar menu-sticky">
    <div class="menu-items">
        <div class="menu-header hidden">
            <a href="#" class="flex items-center mx-8 mt-8">
                <span class="avatar w-16 h-16">JD</span>
                <div class="ltr:ml-4 rtl:mr-4 ltr:text-left rtl:text-right">
                    <h5>John Doe</h5>
                    <p class="mt-2">Editor</p>
                </div>
            </a>
            <hr class="mx-8 my-4">
        </div>
        {{-- Menu Usuario trabajador --}}
        @if (Auth::user()->role->key == 'user')
            <div>
                <a href="{{ route('dashboard') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                    <span class="icon las la-table"></span>
                    <span class="title">Eventos activos</span>
                </a>
                <a href="{{ route('personal-information') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                    <span class="icon las la-id-card"></span>
                    <span class="title">Información Personal</span>
                </a>
                @if (Auth::user()->person )
                    <a href="{{ route('photos') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                        <span class="icon las la-images"></span>
                        <span class="title">Fotos</span>
                    </a>
                @endif
                @if (Auth::user()->person && (count(Auth::user()->person->photos) > 0))
                <a href="{{ route('applications') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                    <span class="icon la la-file-alt"></span>
                    <span class="title">Postulaciones</span>
                </a>
                @endif
            </div>
        @elseif(Auth::user()->role->key == 'admin')
            <a href="{{ route('dashboard') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                <span class="icon la la-laptop"></span>
                <span class="title">Home</span>
            </a>
            <div>
                <a href="{{ route('admin.events') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                    <span class="icon las la-calendar"></span>
                    <span class="title">Eventos</span>
                </a>
            </div>
            <div>
                <a href="{{ route('admin.sponsors') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                    <span class="icon las la-user-alt"></span>
                    <span class="title">Sponsors</span>
                </a>
            </div>
            <div>
                <a href="{{ route('admin.profiles') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                    <span class="icon las la-fingerprint"></span>
                    <span class="title">Perfiles</span>
                </a>
            </div>
            <div>
                <a href="{{ route('admin.users') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                    <span class="icon las la-users"></span>
                    <span class="title">Usuarios</span>
                </a>
            </div>
            
        @endif

    </div>

</aside>
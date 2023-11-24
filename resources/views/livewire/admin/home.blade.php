<div>
    <div class="grid lg:grid-cols-2 gap-5">

        <!-- Summaries -->
        <div class="grid sm:grid-cols-3 gap-5">
            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none las la-users"></span>
                    <p class="mt-2">Total Usuarios</p>
                    <div class="text-primary mt-5 text-3xl leading-none">{{ $cant_users }}</div>
                </div>
            </div>
            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none las la-user-check"></span>
                    <p class="mt-2">Usuarios con info completa</p>
                    <div class="text-primary mt-5 text-3xl leading-none">{{ $cant_users_whith_info }}</div>
                </div>
            </div>
            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none las la-user-minus"></span>
                    <p class="mt-2">Usuarios sin info completa</p>
                    <div class="text-primary mt-5 text-3xl leading-none">{{ $cant_users_whithout_info }}</div>
                </div>
            </div>
        </div>

        <!-- Lines -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none las la-calendar"></span>
                    <p class="mt-2">Eventos Activos</p>
                    <div class="text-primary mt-5 text-3xl leading-none">{{ $cant_events_active }}</div>
                </div>
            </div>
            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none las la-calendar-day"></span>
                    <p class="mt-2">Publicaciones Activas</p>
                    <div class="text-primary mt-5 text-3xl leading-none">{{ $cant_publications_active }}</div>
                </div>
            </div>
            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none las la-eraser"></span>
                    <p class="mt-2">Eventos en Borrador</p>
                    <div class="text-primary mt-5 text-3xl leading-none">{{ $cant_events_draft }}</div>
                </div>
            </div>
            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    {{-- <span class="text-primary text-5xl leading-none la la-sun"></span> --}}
                    <p class="mt-2"></p>
                    <div class="text-primary mt-5 text-3xl leading-none"></div>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="card p-5 flex flex-col">
            <h3>Ultimos Usuarios registrados</h3>
            <table class="table table_list mt-3 w-full">
                <thead>
                    <tr>
                        <th class="ltr:text-left rtl:text-right uppercase">Nombre de usuario</th>
                        <th class="w-px uppercase">email</th>
                        <th class="w-px uppercase">Creado</th>
                        <th class="w-px uppercase"></th>
                        <th class="w-px uppercase">Correo Validado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($last_users as $last_user)
                    <tr>
                        <td>{{ $last_user->name }}</td>
                        <td>{{ $last_user->email }}</td>
                        <td>{{ $last_user->createdAgo() }}</td>
                        <td></td>
                        <td class="text-center">
                            @if ($last_user->email_verified_at != '')
                            <div class="badge badge_outlined badge_success uppercase">Si</div>
                            @else
                            <div class="badge badge_outlined badge_danger uppercase">No</div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-auto">
                <a href="{{ route('admin.users') }}" class="btn btn_primary mt-5">Ver todos los usuarios</a>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="card p-5 flex flex-col">
            <h3>Ultimas Actualizaciones</h3>
            <table class="table table_list mt-3 w-full">
                <thead>
                    <tr>
                        <th class="ltr:text-left rtl:text-right uppercase">Nombre</th>
                        <th class="w-px uppercase">Región</th>
                        <th class="w-px uppercase">Inicio</th>
                        <th class="w-px uppercase">Termino</th>
                        <th class="w-px uppercase">Postulaciones</th>
                        <th class="w-px uppercase">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($last_events as $last_event)
                    <tr>
                        <td> <a href="{{ route('admin.events.publications',[ 'slug'=>$last_event->slug ]) }}">{{ $last_event->name }}</a></td>
                        <td>{{ $last_event->city->region->name }}</td>
                        <td>{{ $last_event->getStartDate() }}</td>
                        <td>{{ $last_event->getDateEnd() }}</td>
                        <td class="text-center">
                            @php $cant = 0; @endphp
                            @foreach ($last_event->publications as $item)
                            @php $cant += $item->person_request->count(); @endphp
                            @endforeach
                            {{ $cant }}
                            {{-- {{ $last_event->publications }} --}}
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

    </div>
</div>

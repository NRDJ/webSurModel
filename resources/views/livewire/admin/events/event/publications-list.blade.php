<div>
    <!-- Hoverable -->
    <div class="card p-5">
        <h3>Publicaciones</h3>
        <table class="table table_hoverable w-full mt-3">
            <thead>
                <tr>
                    <th class="ltr:text-left rtl:text-right uppercase">#</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Estado</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Perfil</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Cantidad</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Colación</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Fecha</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Horario</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Postulaciones</th>
                    <th class="ltr:text-right rtl:text-right uppercase"></th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($publications as $publication)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $publication->state }}</td>
                        <td>{{ $publication->profile->name }}</td>
                        <td>{{ $publication->amount }}</td>
                        <td>{{ $publication->collation }}</td>
                        <td>
                            @if ($publication->date)
                                {{ $publication->getDate() }}
                            @else
                                {{ $publication->event->getStartDate() }} - {{ $publication->event->getDateEnd() }}
                            @endif
                        </td>
                        <td>
                            @if ($publication->start_time && $publication->time_end)
                                {{ $publication->getStartTime() }} - {{ $publication->getTimeEnd() }}
                            @else
                                {{ $publication->event->getStartTime() }} - {{ $publication->event->getTimeEnd() }}
                            @endif
                        </td>
                        <td>
                            <div>
                                Cantidad: {{ count($publication->person_request()->get()) }}
                            </div>
                            <div>
                                <a href="{{ route('admin.events.publication-detail',['slug'=>$publication->event->slug,'id'=>$publication->id]) }}">Detalle</a>
                            </div>
                        </td>
                        <td>
                            <div class="flex justify-end items-center">
                                @livewire('admin.events.event.publications-edit', ['publication' => $publication], key('publication_'.$publication->id))
                                <button wire:click="delete({{ $publication->id }})" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2" >
                                    <span class="la la-trash-alt"></span>
                                </button>
                            </div>
                            
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
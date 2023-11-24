<div>
    <div class="flex gap-x-2">
        <button class="btn btn-icon btn_outlined btn_warning ltr:ml-2 rtl:mr-2" data-toggle="modal" data-target="#view-events-user{{$person->id}}">
            <i class="las la-user-check"></i>
        </button>
    </div>

        <!-- Basic -->
    <div wire:ignore.self id="view-events-user{{ $person->id }}"  class="modal" data-animations="fadeInDown, fadeOutUp" Data-keyword="false">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Eventos que ha postulado el usuario</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="grid lg:grid-cols-1 justify-center items-center">
                    @foreach ($publications as $publication)
                        <div class="card p-5 mt-3">
                            @if ($publication->id === $id_pub)
                                <h3>(Actual)</h3>
                            @endif
                            <h4>Evento {{ $publication->event->name }}
                            </h4>
                            <h4>
                                @if ($publication->date)
                                <p>Fecha {{ $publication->getDate() }}</p>
                                @else
                                <p>Fecha {{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }} </p>
                                @endif
                            </h4>
                            <h4>
                                @if ($publication->start_time && $publication->time_end)
                                <p>Horario {{ $publication->getStartTime() }} a {{ $publication->getTimeEnd() }} </p>
                                @else
                                <p>Horario {{ $publication->event->getStartTime() }} a {{ $publication->event->getTimeEnd() }} </p>
                                @endif
                            </h4>
                            <h4>
                                Ubicación {{ $publication->event->city->region->name }}, {{ $publication->event->city->name }}
                            </h4>
                        </div>
                    @endforeach
                    </div>
                </div>
                
                <div class="modal-footer">
                    <div class="flex ltr:ml-auto rtl:mr-auto">
                        <button type="button" class="btn btn_secondary uppercase" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

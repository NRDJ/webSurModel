<div>
    <!-- List -->    
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <div class="card card_column card_hoverable">
            <div class="image">
                <div class="aspect-w-4 aspect-h-3">
                @if ($publication->event->path_image)
                    <img src="{{ route('event.image',['image'=>$publication->event->path_image]) }}">
                @elseif($publication->event->sponsor->logo)
                    <img src="{{ route('sponsor.image',['image'=>$publication->event->sponsor->logo]) }}">
                @else
                    <img src="{{ asset('img/no-image.jpg') }}">
                @endif
                </div>
                <div
                    class="badge badge_outlined badge_info uppercase absolute top-0 ltr:right-0 rtl:left-0 mt-2 ltr:mr-2 rtl:ml-2">
                    {{ $publication->profile->name }}</div>
            </div>
            <div class="header">
                <!-- nombre -->
                <h5>{{ $publication->event->name }}</h5>
            </div>
            <div class="body">
                <h6 class="uppercase mt-2">Cliente</h6>
                <p>{{ $publication->event->sponsor->contact_name }}</p>
                <h6 class="uppercase mt-2">Ubicación</h6>
                <p>Comuna {{ $publication->event->city->name }}, Región {{ $publication->event->city->region->name }} </p>
                <div class="grid grid-cols-2 gap-2">
                    <div class="">
                        <h6 class="uppercase mt-2">Fecha</h6>
                        @if ($publication->date)
                            <p>{{ $publication->getDate() }}</p>
                        @else
                            <p>{{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }} </p>
                        @endif
                    </div>
                    <div>
                        <h6 class="uppercase mt-2">Horario</h6>
                        @if ($publication->start_time && $publication->time_end)
                            <p>{{ $publication->getStartTime() }} a {{ $publication->getTimeEnd() }} </p>
                        @else
                            <p>{{ $publication->event->getStartTime() }} a {{ $publication->event->getTimeEnd() }} </p>
                        @endif
                    </div>
                </div>
                <h6 class="uppercase mt-2">Cantidad</h6>
                <p>{{ $publication->amount }}</p>
                <h6 class="uppercase mt-2">Remuneración</h6>
                <p>${{ $publication->remuneration }}</p>
                <h6 class="uppercase mt-2">Colación</h6>
                <p>{{ $publication->collation }}</p>
            </div>
            <div class="actions justify-center items-center gap-5 ">
                <button wire:click="approve" type="button" class="btn btn_success uppercase">Aceptar</button>
                <button wire:click="reject" type="button" class="btn btn_danger uppercase">Cancelar</button>
            </div>
        </div>
    </div>

</div>

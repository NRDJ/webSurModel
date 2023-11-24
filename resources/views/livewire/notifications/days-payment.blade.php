<div>
    @section('css')
        <style>
            .container-iframe {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 50%; /* 4:3 Aspect Ratio */
            }
            
            .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
            }
        </style>
    @endsection

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
            </div>
        </div>
        <div class="card p-5 lg:col-span-2">
            <div>
                @if (\Carbon\Carbon::now() < \Carbon\Carbon::parse($publication->event->end_date)->addDays(40))
                    <h5>¿Desea recibir el pago antes del {{ \Carbon\Carbon::parse($publication->event->end_date)->addDays(40)->format('d M') }} ?</h5>
                    <div class="custom-select mt-3">
                        <select wire:model.defer="confirmation" class="form-control">
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>
                    @else
                    <h3>El pago sera recibido el {{ \Carbon\Carbon::parse($publication->event->end_date)->addDays(40)->format('d M') }}</h3>
                @endif
            </div>
            <h3 class="mt-3">Subir Boleta</h3>
            <label wire:ignore.self class="input-group font-normal mt-3" for="customFile">
                <input class="form-control" type="file" name="" wire:model.defer="file" id="{{$identificador}}">
            </label>
            @error('file') 
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1 text-white">
                  {{ $message }}
                </span>
            @enderror
            @if ($file)
            <div class="container-iframe mt-3">
                <iframe class="responsive-iframe" src="{{ $file->temporaryUrl() }}" frameborder="0"></iframe>
            </div>
            <div class="grid lg:grid-cols-1 justify-center items-center mt-3">
                Vista Previa Archivo:
            </div>
            <div class="grid lg:grid-cols-1 justify-center items-center gap-5 mt-5">
                <button type="button" wire:click="send" class="btn btn_outlined btn_primary uppercase">Enviar</button>
            </div>
            @endif
        </div> 
    </div>

</div>

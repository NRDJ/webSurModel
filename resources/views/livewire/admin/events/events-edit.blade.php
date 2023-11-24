<div>
    <button class="btn btn-icon btn_outlined btn_warning" data-toggle="modal" data-target="#edit-event-{{ $event->id }}" title="Editar">
        <span class="la la-pen-fancy"></span>
    </button>

    <!-- Basic -->
    <div 
        wire:ignore.self 
        id="edit-event-{{ $event->id }}" 
        class="modal" 
        data-animations="fadeInDown, fadeOutUp" 
        Data-keyword="false"
        >
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Editar Evento</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <form action="" wire:submit.prevent="update">
                    <div class="modal-body">

                        <div class="flex flex-col gap-y-5 lg:col-span-2">
                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Nombre</label>
                                <input id="input" type="text" class="form-control" placeholder="Nombre evento" wire:model.defer="event.name">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('event.name') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Descripción</label>
                                <textarea name="description" id="description" wire:model.defer="event.description" class="form-control" rows="5"></textarea>
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('event.description') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Cantidad de días</label>
                                <input id="input" type="number"  class="form-control" placeholder="Nombre evento" wire:model.defer="event.number_days">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('event.number_days') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Fecha</label>
                                <div class="input-group mt-2">
                                    <div class="input-addon input-addon-prepend input-group-item">Inicio - Termino</div>
                                    <input type="date" class="form-control input-group-item" placeholder="Fecha Inicio" wire:model.defer="event.start_date">
                                    <input type="date" class="form-control input-group-item" placeholder="Nombre Evento" wire:model.defer="event.end_date">
                                </div>
                                @error('event.start_date') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                                @error('event.end_date') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Horario</label>
                                <div class="input-group mt-2">
                                    <div class="input-addon input-addon-prepend input-group-item">Inicio - Termino</div>
                                    <input type="time" class="form-control input-group-item" placeholder="Fecha Inicio" wire:model.defer="event.start_time">
                                    <input type="time" class="form-control input-group-item" placeholder="Nombre Evento" wire:model.defer="event.time_end">
                                </div>
                                @error('event.start_time') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                                @error('event.time_end') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Estado</label>
                                <div class="custom-select">
                                    <select class="form-control" wire:model.defer="event.state">
                                        <option value="Activo">Activo</option>
                                        <option value="Borrador">Borrador</option>
                                        <option value="Finalizado">Finalizado</option>
                                        <option value="Cancelado">Cancelado</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('event.state') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Sponsor</label>
                                <div class="custom-select">
                                    <select class="form-control" wire:model.defer="event.sponsor_id">
                                        <option value="">Seleccionar</option>
                                        @foreach ($sponsors as $sponsor)
                                            <option value="{{$sponsor->id}}">{{ $sponsor->contact_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('event.sponsor_id') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Ubicación</label>
                                <div class="custom-select">
                                    <select class="form-control" wire:model.defer="region_id" wire:change="onChangeRegion($event.target.value)">
                                        {{-- <option value="">Region</option> --}}
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }} - {{ $region->ordinal }}</option>
                                        @endforeach
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                <div class="custom-select mt-2">
                                    <select class="form-control" wire:model.defer="event.city_id">
                                        {{-- <option value="">Comuna</option> --}}
                                        @if ($cities)
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                <small class="block mt-2">Region/Comuna</small>
                                @error('event.city_id') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            @if ($event->path_image)
                            <div class="mt-2">
                                Imagen actual:
                                <img src="{{ route('event.image',['image'=>$event->path_image]) }}">
                            </div>
                            @endif
                            @if ($image)
                                <div class="mt-2">
                                    Vista Previa Imagen:
                                    <img src="{{ $image->temporaryUrl() }}">
                                </div>
                            @endif

                            <div class="mt-5">
                                {{-- <input type="file" wire:model.defer="image"> --}}
                                <label class="label block mb-2" for="input">Imagen</label>
                                <label class="input-group font-normal" for="{{ $identificador }}">
                                    <div
                                        class="file-name input-addon input-addon-prepend input-group-item w-full overflow-x-hidden">
                                        No file chosen</div>
                                    <input id="{{ $identificador }}" type="file" class="hidden" wire:model.defer="image">
                                    <div class="input-group-item btn btn_primary uppercase">Choose File</div>
                                </label>
                                @error('event.image') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                
                    </div>
                    
                    <div class="modal-footer">
                        <div class="flex ltr:ml-auto rtl:mr-auto">
                            <button type="button" class="btn btn_secondary uppercase" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn_primary ltr:ml-2 rtl:mr-2 uppercase">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

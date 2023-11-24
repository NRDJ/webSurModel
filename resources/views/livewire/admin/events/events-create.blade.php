<div>
    <div class="flex gap-x-2">
        <button class="btn btn_primary uppercase" data-toggle="modal" data-target="#create-event" >Agregar</button>
    </div>

    <!-- Basic -->
    <div 
        wire:ignore.self
        id="create-event" 
        class="modal" 
        data-animations="fadeInDown, fadeOutUp"
        Data-keyword="false"
        >
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Crear Evento</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <form action="" wire:submit.prevent="save">
                    <div class="modal-body">

                        <div class="flex flex-col gap-y-5 lg:col-span-2">
                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Nombre</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Nombre evento" wire:model.defer="name">
                                @error('name') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Descripción</label>
                                <textarea name="description" id="description" wire:model.defer="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="5"></textarea>
                                @error('description') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Cantidad de días</label>
                                <input id="input" type="number"  class="form-control {{ $errors->has('number_days') ? 'is-invalid' : '' }}" placeholder="Nombre evento" wire:model.defer="number_days">
                                @error('number_days') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Fecha</label>
                                <div class="input-group mt-2">
                                    <div class="input-addon input-addon-prepend input-group-item">Inicio - Termino</div>
                                    <input type="date" class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }} input-group-item" placeholder="Fecha Inicio" wire:model.defer="start_date">
                                    <input type="date" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }} input-group-item" placeholder="Nombre Evento" wire:model.defer="end_date">
                                </div>
                                @error('start_date') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                                @error('end_date') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Horario</label>
                                <div class="input-group mt-2">
                                    <div class="input-addon input-addon-prepend input-group-item">Inicio - Termino</div>
                                    <input type="time" class="form-control {{ $errors->has('start_time') ? 'is-invalid' : '' }}"input-group-item" placeholder="Fecha Inicio" wire:model.defer="start_time">
                                    <input type="time" class="form-control {{ $errors->has('time_end') ? 'is-invalid' : '' }}"input-group-item" placeholder="Nombre Evento" wire:model.defer="time_end">
                                </div>
                                @error('start_time') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                                @error('time_end') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Sponsor</label>
                                <div class="custom-select">
                                    <select class="form-control {{ $errors->has('sponsor_id') ? 'is-invalid' : '' }}" wire:model.defer="sponsor_id">
                                        <option seleted value="">Seleccionar</option>
                                        @foreach ($sponsors as $sponsor)
                                            <option value="{{$sponsor->id}}">{{ $sponsor->contact_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('sponsor_id') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Ubicación</label>
                                <div class="custom-select">
                                    <select class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" wire:model.defer="region_id" wire:change="onChangeRegion($event.target.value)">
                                        <option seleted value="">Region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }} - {{ $region->ordinal }}</option>
                                        @endforeach
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                <div class="custom-select mt-2">
                                    <select class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" wire:model.defer="city_id">
                                        <option seleted value="">Comuna</option>
                                        @if ($cities)
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                <small class="block mt-2">Region/Comuna</small>
                                @error('city_id') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            @if ($image)
                                <div class="mt-5">
                                    Vista Previa Imagen:
                                    <img src="{{ $image->temporaryUrl() }}">
                                </div>
                            @endif

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Imagen</label>
                                <label class="input-group font-normal" for="{{$identificador}}">
                                    <div
                                        class="file-name input-addon input-addon-prepend input-group-item w-full overflow-x-hidden ">
                                        No file chosen</div>
                                    <input id="{{$identificador}}" type="file" class="hidden" wire:model.defer="image">
                                    <div class="input-group-item btn btn_primary uppercase">Choose File</div>
                                </label>
                                @error('image') 
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
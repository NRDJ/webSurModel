<div>
    <button class="btn btn-icon btn_outlined btn_warning" data-toggle="modal" data-target="#edit-event-{{ $publication->id }}" title="Editar">
        <span class="la la-pen-fancy"></span>
    </button>

    <!-- Basic -->
    <div wire:ignore.self id="edit-event-{{ $publication->id }}" class="modal" data-animations="fadeInDown, fadeOutUp" Data-keyword="false">
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
                                <label class="label block mb-2" for="input">Remuneración</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('publication.remuneration') ? 'is-invalid' : '' }}" placeholder="Remuneración" wire:model.defer="publication.remuneration">
                                @error('publication.remuneration') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Cantidad</label>
                                <input id="input" type="number"  class="form-control {{ $errors->has('publication.amount') ? 'is-invalid' : '' }}" placeholder="cantidad" wire:model.defer="publication.amount">
                                @error('publication.amount') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Colación</label>
                                <div class="custom-select">
                                    <select class="form-control {{ $errors->has('publication.collation') ? 'is-invalid' : '' }}" wire:model.defer="publication.collation">
                                        <option seleted value="">Seleccionar</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('publication.collation') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Estado</label>
                                <div class="custom-select">
                                    <select class="form-control {{ $errors->has('publication.state') ? 'is-invalid' : '' }}" wire:model.defer="publication.state">
                                        <option seleted value="">Seleccionar</option>
                                        <option value="Activo">Activa</option>
                                        <option value="Borrador">Borrador</option>
                                        <option value="Cancelado">Cancelado</option>
                                        <option value="Finalizado">Finalizado</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('publication.state') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Fecha</label>
                                <div class="input-group mt-2">
                                    <div class="input-addon input-addon-prepend input-group-item"></div>
                                    <input type="date" class="form-control {{ $errors->has('publication.date') ? 'is-invalid' : '' }} input-group-item" placeholder="Fecha Inicio" wire:model.defer="publication.date">
                                    {{-- <input type="date" class="form-control {{ $errors->has('rut') ? 'is-invalid' : '' }} input-group-item" placeholder="Nombre Evento" wire:model.defer="publication.end_date"> --}}
                                </div>
                                @error('publication.date') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Horario</label>
                                <div class="input-group mt-2">
                                    <div class="input-addon input-addon-prepend input-group-item">Inicio - Termino</div>
                                    <input type="time" class="form-control {{ $errors->has('publication.start_time') ? 'is-invalid' : '' }} input-group-item" placeholder="Fecha Inicio" wire:model.defer="publication.start_time">
                                    <input type="time" class="form-control {{ $errors->has('publication.time_end') ? 'is-invalid' : '' }} input-group-item" placeholder="Nombre Evento" wire:model.defer="publication.time_end">
                                </div>
                                @error('publication.start_time') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                                @error('publication.time_end') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Perfil requerido</label>
                                <div class="custom-select">
                                    <select class="form-control {{ $errors->has('publication.profile_id') ? 'is-invalid' : '' }}" wire:model.defer="publication.profile_id">
                                        <option seleted value="">Seleccionar</option>
                                        @foreach ($profiles as $profile)
                                            <option value="{{$profile->id}}">{{ $profile->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('publication.profile_id') 
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

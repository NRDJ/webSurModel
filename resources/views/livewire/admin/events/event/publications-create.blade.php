<div>
    <div class="flex gap-x-2">
        <button class="btn btn_primary uppercase" 
            data-toggle="modal" data-target="#create-publication" 
            >Agregar</button>
    </div>

        <!-- Basic -->
    <div wire:ignore.self id="create-publication"  class="modal" data-animations="fadeInDown, fadeOutUp" Data-keyword="false">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Agregar publicación</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <form action="" wire:submit.prevent="save">
                    <div class="modal-body">

                        <div class="flex flex-col gap-y-5 lg:col-span-2">
                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Remuneración</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('remuneration') ? 'is-invalid' : '' }}" placeholder="Remuneración" wire:model.defer="remuneration">
                                @error('remuneration') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Cantidad</label>
                                <input id="input" type="number"  class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="cantidad" wire:model.defer="amount">
                                @error('amount') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Colación</label>
                                <div class="custom-select">
                                    <select class="form-control {{ $errors->has('collation') ? 'is-invalid' : '' }}" wire:model.defer="collation">
                                        <option seleted value="">Seleccionar</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('collation') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Estado</label>
                                <div class="custom-select">
                                    <select class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" wire:model.defer="state">
                                        <option seleted value="">Seleccionar</option>
                                        <option value="Activo">Activa</option>
                                        <option value="Borrador">Borrador</option>
                                        <option value="Cancelado">Cancelado</option>
                                        <option value="Finalizado">Finalizado</option>
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('state') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Fecha</label>
                                <div class="input-group mt-2">
                                    <div class="input-addon input-addon-prepend input-group-item"></div>
                                    <input type="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }} input-group-item" placeholder="Fecha Inicio" wire:model.defer="date">
                                </div>
                                @error('date') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Horario</label>
                                <div class="input-group mt-2">
                                    <div class="input-addon input-addon-prepend input-group-item">Inicio - Termino</div>
                                    <input type="time" class="form-control {{ $errors->has('start_time') ? 'is-invalid' : '' }} input-group-item" placeholder="Fecha Inicio" wire:model.defer="start_time">
                                    <input type="time" class="form-control {{ $errors->has('time_end') ? 'is-invalid' : '' }} input-group-item" placeholder="Nombre Evento" wire:model.defer="time_end">
                                </div>
                                @error('start_time') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                                @error('time_end') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Perfil requerido</label>
                                <div class="custom-select">
                                    <select class="form-control {{ $errors->has('profile_id') ? 'is-invalid' : '' }}" wire:model.defer="profile_id">
                                        <option seleted value="">Seleccionar</option>
                                        @foreach ($profiles as $profile)
                                            <option value="{{$profile->id}}">{{ $profile->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                                @error('profile_id') 
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

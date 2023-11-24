<div>
    <div class="flex gap-x-2">
        <button class="btn btn_primary uppercase" 
            {{-- wire:click="openModal" --}}
            data-toggle="modal" data-target="#create-profile" 
            {{-- wire:click="$set('open',true)" --}}
            >Agregar</button>
    </div>

        <!-- Basic -->
    <div wire:ignore.self id="create-profile"  class="modal" data-animations="fadeInDown, fadeOutUp" Data-keyword="false">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Agregar nuevo Perfil</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <form action="" wire:submit.prevent="save">
                    <div class="modal-body">

                        {{-- <div class="flex flex-col gap-y-5 lg:col-span-1"> --}}
                        <div class="" >

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Nombre</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" wire:model.defer="name" placeholder="name">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('name') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Descripción</label>
                                <textarea name="description" id="description" wire:model.defer="description" class="form-control" rows="5"></textarea>
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('description') 
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </span>
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

<div>
    <div class="flex gap-x-2">
        <button class="btn btn_primary uppercase" data-toggle="modal" data-target="#create-sponsor" >Agregar</button>
    </div>

        <!-- Basic -->
        <div 
        wire:ignore.self
        id="create-sponsor" 
        class="modal" 
        data-animations="fadeInDown, fadeOutUp"

        Data-keyword="false"
        >
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Nuevo Sponsor</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <form action="" wire:submit.prevent="save">
                    <div class="modal-body">

                        {{-- <div class="flex flex-col gap-y-5 lg:col-span-1"> --}}
                        <div class="" >

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Rut</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('rut') ? 'is-invalid' : '' }}" wire:model.defer="rut" placeholder="rut">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('rut') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Nombre de contacto</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" wire:model.defer="contact_name" placeholder="contact_name">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('contact_name') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Razón social</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('business_name') ? 'is-invalid' : '' }}" wire:model.defer="business_name" placeholder="business_name">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('business_name') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Giro Principal</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('main_line') ? 'is-invalid' : '' }}" wire:model.defer="main_line" placeholder="main_line">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('main_line') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Dirección comercial</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('commercial_address') ? 'is-invalid' : '' }}" wire:model.defer="commercial_address" placeholder="commercial_address">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('commercial_address') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Telefono</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" wire:model.defer="contact_phone" placeholder="contact_phone">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('contact_phone') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            @if ($image)
                                <div class="mt-2">
                                    Vista Previa Imagen:
                                    <img src="{{ $image->temporaryUrl() }}">
                                </div>
                            @endif

                            <div class="mt-2">
                                <label class="label block mb-2" for="input">Imagen</label>
                                <label class="input-group font-normal" for="{{$identificador}}">
                                    <div
                                        class="file-name input-addon input-addon-prepend input-group-item w-full overflow-x-hidden">
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

<div>
    <button class="btn btn-icon btn_outlined btn_warning" data-toggle="modal" data-target="#edit-sponsor{{ $sponsor->id }}">
        <span class="la la-pen-fancy"></span>
    </button>
    

    <!-- Basic -->
    <div wire:ignore.self id="edit-sponsor{{ $sponsor->id }}"  class="modal" data-animations="fadeInDown, fadeOutUp" Data-keyword="false">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Editar Sponsor {{ $sponsor->contact_name }}</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <form action="" wire:submit.prevent="update">
                    <div class="modal-body">

                        {{-- <div class="flex flex-col gap-y-5 lg:col-span-1"> --}}
                        <div class="" >

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >rut</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('sponsor.rut') ? 'is-invalid' : '' }}" wire:model.defer="sponsor.rut" placeholder="rut">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('sponsor.rut') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Nombre de contacto</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('sponsor.contact_name') ? 'is-invalid' : '' }}" wire:model.defer="sponsor.contact_name" placeholder="contact_name">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('sponsor.contact_name') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Razón social</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('sponsor.business_name') ? 'is-invalid' : '' }}" wire:model.defer="sponsor.business_name" placeholder="business_name">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('sponsor.business_name') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Giro principal</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('sponsor.main_line') ? 'is-invalid' : '' }}" wire:model.defer="sponsor.main_line" placeholder="main_line">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('sponsor.main_line') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Dirección comercial</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('sponsor.commercial_address') ? 'is-invalid' : '' }}" wire:model.defer="sponsor.commercial_address" placeholder="commercial_address">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('sponsor.commercial_address') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Telefono</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('sponsor.contact_phone') ? 'is-invalid' : '' }}" wire:model.defer="sponsor.contact_phone" placeholder="contact_phone">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('sponsor.contact_phone') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            @if ($sponsor->logo)
                            <div class="mt-2">
                                Imagen actual:
                                <img src="{{ route('sponsor.image',['image'=>$sponsor->logo]) }}">
                            </div>
                            @endif
                            @if ($image)
                                <div class="mt-2">
                                    Vista Previa Imagen:
                                    <img src="{{ $image->temporaryUrl() }}">
                                </div>
                            @endif

                            <div class="mt-2">
                                <label class="label block mb-2" for="input">Logo</label>
                                <label class="input-group font-normal" for="{{ $identificador }}">
                                    <div
                                        class="file-name input-addon input-addon-prepend input-group-item w-full overflow-x-hidden">
                                        No file chosen</div>
                                    <input id="{{ $identificador }}" type="file" class="hidden" wire:model.defer="image">
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

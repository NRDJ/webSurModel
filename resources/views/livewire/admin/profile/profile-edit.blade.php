<div>
    <button class="btn btn-icon btn_outlined btn_warning" data-toggle="modal" data-target="#edit-profile-{{ $profile->id }}">
        <span class="la la-pen-fancy"></span>
    </button>

        <!-- Basic -->
    <div wire:ignore.self id="edit-profile-{{ $profile->id }}"  class="modal" data-animations="fadeInDown, fadeOutUp" Data-keyword="false">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Editar perfil</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <form action="" wire:submit.prevent="update">
                    <div class="modal-body">

                        {{-- <div class="flex flex-col gap-y-5 lg:col-span-1"> --}}
                        <div class="" >

                            <div class="mt-2">
                                <label class="label block mb-2" for="input" >Nombre</label>
                                <input id="input" type="text" class="form-control {{ $errors->has('profile.name') ? 'is-invalid' : '' }}" wire:model.defer="profile.name" placeholder="name">
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('profile.name') 
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label class="label block mb-2" for="input">Descripción</label>
                                <textarea name="description" id="description" wire:model.defer="profile.description" class="form-control" rows="5"></textarea>
                                {{-- <small class="block mt-2">This is help text.</small> --}}
                                @error('profile.description') 
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

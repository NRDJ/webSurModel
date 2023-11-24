<div>

    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="flex w-full h-screen items-center justify-center">
            <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase cursor-pointer hover:bg-blue hover:text-white">
                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                </svg>
                <span class="mt-2 text-base leading-normal">Select a file</span>
                <input wire:model.defer="images" type='file' class="form-control" id="images_{{$identificador}}" multiple/>
                <button type="submit" wire:click="upload" class="btn btn_primary uppercase mt-3">Subir Imagen</button>
                @error('images.*') 
                    <span class="mt-2 flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                    </span>
                @enderror
            </label>
        </div>

        @foreach ($photos as $photo)        
            <div class="card card_column card_hoverable">
                <div class="image">
                    <div class="aspect-w-4 aspect-h-3">
                        <img src="{{ route('my-photo',[Auth::user()->id,$photo->photo_path])}}">
                    </div>
                </div>
                <div class="header grid grid-cols-2 gap-4">
                    <h5>{{ $photo->uploadedAgo() }}</h5>
                    <div class="flex justify-end">
                        <div class="grid lg:grid-cols-2 gap-2">
                            <div>
                                <button class="btn btn_primary uppercase" 
                                data-toggle="modal" title="Ver imagen en tamaño original" data-target="#detail_photo_{{ $photo->id }}" 
                                >
                                    <i class="las la-eye"></i>
                                </button>
                            </div>
                            <div>
                                <button wire:click="delete({{ $photo->id }})" title="Eliminar" class="btn btn_outlined btn_danger">
                                    {{-- <span class="la la-star ltr:mr-2 rtl:ml-2"></span> --}}
                                    <i class="lar la-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @foreach ($photos as $photo)
    <div 
    wire:ignore.self
        id="detail_photo_{{ $photo->id }}" 
        class="modal" 
        data-animations="fadeInDown, fadeOutUp"
        Data-keyword="false"

        >
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Vista</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                    <div class="modal-body">
                        <img src="{{ route('my-photo',[ 'id'=>Auth::user()->id, 'image'=>$photo->photo_path ]) }}" alt="">
                    </div>
                    
                    <div class="modal-footer">
                        <div class="flex ltr:ml-auto rtl:mr-auto">
                            <button type="button" class="btn btn_secondary uppercase" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endforeach



</div>

<div>
    <div class="card p-5">
        <h3>Fotos</h3>
        <div id="carousel-style-1" class="glide mt-5">
            <div class="glide__track" data-glide-el="track">
                <div class="glide__slides" >
                    @foreach ($photos as $photo)
                    <div class="glide__slide">
                        <div class="card card_column card_hoverable">
                            <div class="image">
                                <div class="aspect-w-4 aspect-h-3">
                                    <img src="{{ route('my-photo',[ 'id'=>$photo->person->user->id, 'image'=>$photo->photo_path ]) }}">
                                </div>
                                @livewire('admin.users.photos.select-photos',['photo'=>$photo, 'values'=>$values,'person'=>$photo->person ],key('photo_'.$photo->id))
                            </div>
                            <div class="header">
                                <h5>Imagen n° {{ $loop->index+1 }}</h5>
                                <div class="grid lg:grid-cols-1 justify-center items-center">
                                    <button class="btn btn_primary uppercase" 
                                        data-toggle="modal" title="Ver imagen en tamaño original" data-target="#detail_photo_{{ $photo->id }}" 
                                        >Ver</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="glide__bullets" data-glide-el="controls[nav]">
                @for ($i = 0; $i < $cant; $i++)
                <button class="glide__bullet" data-glide-dir="={{$i}}"></button>
                @endfor
            </div>
            <div class="glide__arrows" data-glide-el="controls">
                <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><span
                        class="la la-arrow-left"></span></button>
                <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><span
                        class="la la-arrow-right"></span></button>
            </div>
        </div>
    </div>

    @foreach ($photos as $photo)
    <div 
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
                        <img src="{{ route('my-photo',[ 'id'=>$photo->person->user->id, 'image'=>$photo->photo_path ]) }}" alt="">
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



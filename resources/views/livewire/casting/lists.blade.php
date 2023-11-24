<div>
    
    <hr class="my-5 dark:border-gray-800">

    <!-- List -->
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach ($people as $person)
            <div class="card card_column card_hoverable">
                <div class="image">
                    <div class="aspect-w-4 aspect-h-3">
                        @php
                            $photo_path_confirmed = 0;
                            for ($i=0; $i < count($person->photos); $i++) { 
                                if ($person->photos[$i]->confirmed == 1) {
                                    $photo_path_confirmed = $person->photos[$i]->photo_path;
                                    break;
                                }
                            }
                        @endphp
                        <img src="{{ URL::temporarySignedRoute('access.temporal.photos',now()->addSeconds(5),['id' => $person->user->id, 'image'=>$photo_path_confirmed ]) }}">
                    </div>
                </div>
                <div class="header">
                    <h3>{{ $person->name }}, {{ $person->getAge() }} años, {{ ($person->features->height)/100 }} mts</h3>
                    <div class="mt-5">
                        <button class="btn btn_primary uppercase" data-toggle="modal"
                            data-target="#scrollable-{{ $person->id }}">Ver fotos</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    @foreach ($people as $person)
    <!-- Scrollable -->
    <div id="scrollable-{{ $person->id }}" class="modal" data-animations="fadeInDown, fadeOutUp">
        <div class="modal-dialog modal-dialog_scrollable max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">{{ $person->name }}, {{ $person->getAge() }} años, {{ ($person->features->height)/100 }} mts</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @foreach ($person->photos as $photo)
                        @if ($photo->confirmed)
                        <div class="mt-3">
                            <img src="{{ URL::temporarySignedRoute('access.temporal.photos',now()->addSeconds(5),[ 'id'=>$person->user->id, 'image'=>$photo->photo_path ]) }}" width="500" alt="">
                        </div>
                        <hr>
                        @endif
                    @endforeach
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

<div>
    <div class="container-fluid bg_gris_claro position-relative">
        <img src="img/circulo_sm.svg" class="circulo_trabajos" alt="Circulo SurModel">
        <div class="container">
            <div class="row justify-content-evenly"> 
                <div class="col-12 col-md-7 mb-4 padd_small_top text-center px-0">
                    <form action="">
                        <div class="row text-white">
                            <div class="col-12 col-lg-6 form-floating mb-4 px-2">
                                <select class="form-select" aria-label="Default select example" wire:change="filtroPerfiles($event.target.value)">
                                    <option selected value="">---------</option>
                                    @foreach ($profiles as $profile)
                                    <option value="{{$profile->id}}">{{$profile->name}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput" class="opacity">Cargo</label>
                            </div>

                            <div class="col-12 col-lg-6 form-floating mb-4 px-2">
                                <select class="form-select" wire:change="filtroRegion($event.target.value)" aria-label="Default select example">
                                    <option selected value="">---------</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->ordinal }} - {{ $region->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput" class="opacity">Regiones</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
      
    <div class="container-fluid bg_gris_claro padd_small_bottom padd_small_top">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($publications as $publication)
                <div class="col-12 col-md-4 col-lg-3 text-center border_trabajos px-0 mb-5 mx-0 mx-md-2">
                    <h1 class="tit_cargos text-white">{{ $publication->profile->name }}</h1>
                    @if ($publication->event->path_image)
                        <img src="{{ route('event.image',['image'=>$publication->event->path_image]) }}" class="img_trabajos" alt="{{$publication->event->name}}_{{ $publication->profile }}" >
                    @elseif($publication->event->sponsor->logo)
                        <img src="{{ route('sponsor.image',['image'=>$publication->event->sponsor->logo]) }}" class="img_trabajos" alt="{{$publication->event->name}}_{{ $publication->profile }}">
                    @else
                        <img src="{{ asset('img/no-image.jpg') }}" class="img_trabajos" alt="{{$publication->event->name}}_{{ $publication->profile }}">
                    @endif
                    <button class="btn_info_tra mt-4 mb-5" data-bs-toggle="modal" data-bs-target="#info{{$publication->event->id}}_{{ $publication->id }}">Información</button>
                </div>
                @endforeach
            </div>
        </div>  
    </div>


    @foreach ($publications as $publication)
    <div class="modal fade" id="info{{$publication->event->id}}_{{ $publication->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!--<div class="modal-header">
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>-->
                <div class="modal-body">
                    <div class="row shadow_modal">
                        <div class="col-12 col-md-4 p-0">
                            <img src="img/bg_modal.jpg" class="img_modal" alt="bg Modal">
                        </div>

                        <div class="col-12 col-md-8 bg_oscuro text-white p-5">
                            <img src="img/logo_SM_blanco.svg" class="logo_opacity pb-5" height="" alt="Logo SurModel Blanco">
                            <p>
                            <span class="tit_info_modal">Cliente</span> <br> {{ $publication->event->sponsor->contact_name }} <br><br>
                            <span class="tit_info_modal">Cargo</span> <br> {{ $publication->profile->name }} <br><br>
                            <span class="tit_info_modal">Fecha</span> <br> @if ($publication->date) {{ $publication->getDate() }} @else {{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }} @endif <br><br>
                            <span class="tit_info_modal">Horario</span> <br> @if ($publication->start_time && $publication->time_end) {{ $publication->getStartTime() }} a {{ $publication->getTimeEnd() }} @else {{ $publication->event->getStartTime() }} a {{ $publication->event->getTimeEnd() }} @endif <br><br>
                            <span class="tit_info_modal">Ubicación</span> <br> Comuna {{ $publication->event->city->name }}, Región {{ $publication->event->city->region->name }}<br><br>
                            <span class="tit_info_modal">Remuneración</span> <br> {{ $publication->remuneration }} <br><br>
                            <span class="tit_info_modal">Vacantes</span> <br> {{ $publication->amount }} <br><br>
                            </p>
                            <div class="text-center">
                                {{-- <button type="submit" class="btn_gral mt-4">Postular</button> --}}
                                <a href="{{ route('login')}}" class="btn_gral mt-4">Postular</a>
                            </div>
                        </div>

                        <div class="col-12 bg_fucsia pt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

<div>

    <!-- detalle -->
    <div class=" justify-center">
        <!--detalle-->
        <div class="card p-5">
            <h3>{{ $publication->profile->name }} para {{ $publication->event->name }}</h3>
            <div class="grid lg:grid-cols-2 mt-3">
                <h5>Ubicación</h5>
                <p>Región {{ $publication->event->city->region->name }}, Comuna {{$publication->event->city->name }}</p>
            </div>
            <div class="grid lg:grid-cols-2">
                <h5>Cantidad de días del evento</h5>
                <p>{{ $publication->event->number_days }}</p>
            </div>
            <div class="grid lg:grid-cols-2">
                <h5>Sponsor</h5>
                <p>{{ $publication->event->sponsor->contact_name }}</p>
            </div>
            <div class="grid lg:grid-cols-2">
                <h5>Remuneración</h5>
                <p>${{ $publication->remuneration }}</p>
            </div>
            <div class="grid lg:grid-cols-2">
                <h5>Cantidad de personas requeridas</h5>
                <p>{{ $publication->amount }}</p>
            </div>
            <div class="grid lg:grid-cols-2">
                <h5>Colación</h5>
                <p>{{ $publication->collation }}</p>
            </div>
            <div class="grid lg:grid-cols-2">
                <h5>Fecha</h5>
                @if ($publication->date )
                    <p>{{ $publication->getDate() }}</p>    
                @else
                    <p>{{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }}</p>
                @endif
            </div>
            <div class="grid lg:grid-cols-2">
                <h5>Horario</h5>
                @if ($publication->start_time && $publication->time_end )
                <p>{{ $publication->event->getStartTime() }} a {{ $publication->event->getTimeEnd() }}</p>
                @else
                    <p>{{ $publication->event->getStartDate() }} al {{ $publication->event->getDateEnd() }}</p>
                @endif
            </div>
        </div>
        <!--filtro-->
        
        <div class="card p-5 mt-5">
            <h3>Filtros</h3>
            <div class="grid grid-cols-1">
                <!-- región comuna -->
                <h4 class="mt-3">Ubicación</h4>
                <div class="grid grid-cols-2 gap-2 mt-3">
                    <div>
                        <h4>Región</h4>
                        <div class="custom-select">
                            <select wire:model.defer="region_id" wire:change="onChangeRegion($event.target.value)" class="form-control">
                                <option selected value="">Todas las regiones</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}" >
                                        {{ $region->name }} - {{ $region->ordinal }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div>
                        <h4>Comuna</h4>
                        <div class="custom-select">
                            <select wire:model.defer="city_id" wire:change="onChangeCity($event.target.value)" class="form-control">
                                <option selected value="">Todas las comunas</option>
                                @if ($ciudades)
                                    @foreach ($ciudades as $city)
                                        <option class="text-light" value="{{ $city->id }}" >
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                </div>
                
                <!-- genero -->
                <h4 class="mt-3">Detalles</h4>
                <div class="grid lg:grid-cols-4 gap-2 mt-3">
                    <div class="">
                        <h4>Genero</h4>
                        <div class="custom-select">
                            <select wire:model.defer="gender_id" wire:change="onChangeGeneros($event.target.value)" class="form-control">
                                <option value="" selected>-- Seleccionar todo --</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div>
                        <h4>Estatura</h4>
                        <div class="custom-select">
                            <select wire:change="onChangeEstaura($event.target.value)" class="form-control">
                                <option value="" selected>-- Seleccionar todo --</option>
                                @foreach ($list_height as $item)
                                    <option value="{{$item}}">{{$item}} cms</option>
                                @endforeach
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div>
                        <h4>Peso</h4>
                        <div class="custom-select">
                            <select wire:change="onChangePeso($event.target.value)" class="form-control">
                                <option value="" selected>-- Seleccionar todo --</option>
                                @foreach ($list_weight as $item)
                                    <option value="{{$item}}">{{$item}} kg</option>
                                @endforeach
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div>
                        <h4>Edad</h4>
                        <div class="custom-select">
                            <select wire:change="onChangeAge($event.target.value)" class="form-control">
                                <option value="" selected>-- Seleccionar todo --</option>
                                @for ($i = $min_age+1; $i <= $max_age+1; $i++)
                                  <option value="{{$i}}">{{ $i-1 }} a {{ $i }} años</option>
                                @endfor
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                </div>

                <div class="grid lg:grid-cols-4 gap-2 mt-3">
                    <div class="">
                        <h4>Talla Polera</h4>
                        <div wire:change="onChangeTallaPolera($event.target.value)" class="custom-select">
                            <select class="form-control">
                                <option value="" selected>-- Seleccionar todo --</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div>
                        <h4>Talla pantalón</h4>
                        <div wire:change="onChangeTallaPantalon($event.target.value)" class="custom-select">
                            <select class="form-control">
                                <option value="" selected>-- Seleccionar todo --</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div>
                        <h4>Color Pelo</h4>
                        <div class="custom-select">
                            <select wire:change="onChangeColorPelo($event.target.value)" class="form-control">
                                <option value="" selected>-- Seleccionar todos --</option>
                                @foreach ($list_hair_color as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div>
                        <h4>Color Ojos</h4>
                        <div wire:change="onChangeColorOjos($event.target.value)" class="custom-select">
                            <select class="form-control">
                                <option value="" selected>-- Seleccionar todos --</option>
                                <option value="castaños">castaños</option>
                                <option value="miel">miel</option>
                                <option value="verdes">verdes</option>
                                <option value="azules">azules</option>
                                <option value="grises">grises</option>
                                <option value="negros">negros</option>
                                <option value="otros">otros</option>
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="card p-5">
            <div class="grid lg:grid-cols-3">
                <div>
                    <button wire:click="sendMail" class="btn btn_outlined btn_primary uppercase"
                    data-toggle="tooltip"
                    data-tippy-content="Enviar notificación por email a usuarios y cambiar estado a seleccionado" data-tippy-placement="right">
                        <span class="icon las la-envelope ltr:mr-2 rtl:ml-2"></span>
                    </button>
                </div>
                <div>
                    <button wire:click="sendMailPaymentDays" class="btn btn_outlined btn_primary uppercase"
                    data-toggle="tooltip"
                    data-tippy-content="enviar notificacion por email a usuarios para que envien la boleta" data-tippy-placement="right">
                        <i class="icon las la-envelope-open-text ltr:mr-2 rtl:ml-2"></i>
                    </button>
                </div>
                <div>
                    {{-- <a href="{{ route('admin.publication.generate-pdf',[ 'slug'=>$publication->event->slug ,'id'=>$publication->id ] ) }}" class="btn btn_outlined btn_primary uppercase"
                        data-toggle="tooltip"
                        data-tippy-content="Generar PDF con las fotos de los usuarios en estado Preseleccionados" data-tippy-placement="right">
                        <i class="icon lar la-file-pdf ltr:mr-2 rtl:ml-2"></i>
                    </a> --}}
                    <a href="{{ URL::temporarySignedRoute('casting', now()->addDays(3), [ 'slug'=>$publication->event->slug ,'id'=>$publication->id ]) }}" class="btn btn_outlined btn_primary uppercase"
                        target="_blank"
                        data-toggle="tooltip"
                        data-tippy-content="Generar Vista con las fotos de los usuarios en estado Preseleccionados" data-tippy-placement="right">
                        <i class="icon lar la-file-pdf ltr:mr-2 rtl:ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- List -->
    <div class="card p-5 mt-5">
        <div class="overflow-x-auto">
            <table class="table table-auto table_hoverable w-full">
                <thead>
                    <tr>
                        <th class="w-px">
                            {{-- <label class="custom-checkbox">
                                <input type="checkbox" checked partial>
                                <span></span>
                            </label> --}}
                        </th>
                        <th class="ltr:text-left rtl:text-right uppercase">Usuario</th>
                        <th class="text-center uppercase">Rut</th>
                        <th class="text-center uppercase">Email</th>
                        <th class="text-center uppercase">Telefono</th>
                        <th class="text-center uppercase">Edad</th>
                        <th class="text-center uppercase">Estado</th>
                        <th class="uppercase"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        <tr>
                            <td>
                                <label class="custom-checkbox">
                                    <input type="checkbox" value="{{ $person->id }}" wire:model.defer="values" data-toggle="rowSelection">
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <div>
                                    {{-- foto --}}
                                </div>
                                <div>
                                    {{ $person->name }} {{ $person->last_name }}
                                </div>
                            </td>
                            <td class="text-center">
                                {{ $person->rut }}
                            </td>
                            <td class="text-center">
                                {{ $person->user->email }}
                            </td>
                            <td class="text-center">
                                {{ $person->phone }}
                            </td>
                            <td class="text-center">
                                {{ $person->getAge() }}
                            </td>
                            <td class="text-center">
                                {{-- <div class="badge badge_outlined badge_secondary uppercase">Draft</div> --}}
                                @livewire('admin.events.event.publication.select-user', [ 'person' => $person,'publication'=>$publication], key('select_'.$person->id))
                            </td>
                            <td class="ltr:text-right rtl:text-left whitespace-nowrap">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    @php
                                        $pr= \App\Models\User\PersonRequest::where('person_id',$person->id)->where('publication_id',$publication->id)->first();
                                        $payment = \App\Models\Payment\Payment::where('person_request_id',$pr->id)->first();
                                    @endphp
                                    @if ($payment && $person->person_request()->where('publication_id',$publication->id)->first()->pivot->state == "Confirmado" )
                                    <a href="{{ route('admin.events.invoice',['slug'=>$publication->event->slug,'publication' => $publication,'person' => $person]) }}" class="btn btn-icon btn_outlined btn_primary">
                                        <span class="las la-file-invoice-dollar"></span>
                                    </a>
                                    @endif
                                    <a href="{{ route('admin.users.photos',[ 'person'=>$person ]) }}" class="btn btn-icon btn_outlined btn_secondary ltr:ml-2 rtl:mr-2">
                                        <span class="las la-images"></span>
                                    </a>
                                    <button class="btn btn-icon btn_outlined btn_info ltr:ml-2 rtl:mr-2" data-toggle="modal"
                                        data-target="#userModal{{ $person->id }}">
                                        <i class="las la-info"></i>
                                    </button>
                                    @livewire('admin.users.settings.events-list', ['person' => $person,'id_pub'=>$publication->id], key('person_check_events_'.$person->id))
                                    {{-- <a href="#" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-trash-alt"></span>
                                    </a> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($people as $person)
    <!-- Basic -->
    <div id="userModal{{ $person->id }}" class="modal" data-animations="fadeInDown, fadeOutUp">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Detalle Usuario {{ "@".$person->user->name }}</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Rut</h4>
                        </div>
                        <div>
                            <h4>{{ $person->rut }}</h4>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Nombre</h4>
                        </div>
                        <div>
                            <h4>{{ $person->name }}</h4>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Apellidos</h4>
                        </div>
                        <div>
                            <h4>{{ $person->last_name }}</h4>
                        </div>
                    </div>
                    
                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Nacionalidad</h4>
                        </div>
                        <div>
                            <h4>{{ $person->country->demonym }}</h4>
                        </div>
                    </div>

                   <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Género</h4>
                        </div>
                        <div>
                            <h4>{{ $person->gender }}</h4>
                        </div>
                    </div>

                   <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Fecha de Nacimiento</h4>
                        </div>
                        <div>
                            <h4>{{ $person->getBirthDate() }}</h4>
                            <h4>{{ $person->getAge()." años" }}</h4>
                        </div>
                    </div>


                   <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Contacto</h4>
                        </div>
                    </div>
                

                   <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Correo</h4>
                        </div>
                        <div>
                            <h4>{{ $person->user->email }}</h4>
                        </div>
                    </div>
                

                   <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Telefono</h4>
                        </div>
                        <div>
                            <h4>{{ $person->phone }}</h4>
                        </div>
                    </div>

                   <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Ubicación</h4>
                        </div>
                    </div>
                

                   <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Región</h4>
                        </div>
                        <div>
                            <h4>{{ $person->city->region->ordinal }} - {{ $person->city->region->name }}</h4>
                        </div>
                    </div>
                

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Comuna</h4>
                        </div>
                        <div>
                            <h4>{{ $person->city->name }}</h4>
                        </div>
                    </div>
                    
                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Instagram</h4>
                        </div>
                        <div>
                            <h4>{{ $person->instagram }}</h4>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Profesión</h4>
                        </div>
                        <div>
                            <h4>{{ $person->profession }}</h4>
                        </div>
                    </div>

                    <hr class="mt-3">
                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Color de Ojos</h4>
                        </div>
                        <div>
                            <h4>{{ $person->features->eyes_color }}</h4>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Color de Pelo</h4>
                        </div>
                        <div>
                            <h4>{{ $person->features->hair_color }}</h4>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Altura</h4>
                        </div>
                        <div>
                            <h4>{{ $person->features->height." cms" }}</h4>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Peso</h4>
                        </div>
                        <div>
                            <h4>{{ $person->features->weight." Kg" }}</h4>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Talla Polera</h4>
                        </div>
                        <div>
                            <h4>{{ $person->features->shirt_size }}</h4>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 mt-3 gap-5">
                        <div>
                            <h4>Talla Pantalón</h4>
                        </div>
                        <div>
                            <h4>{{ $person->features->pants_size }}</h4>
                        </div>
                    </div>

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

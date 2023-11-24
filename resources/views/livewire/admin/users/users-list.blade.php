<div>
    <section class="breadcrumb">
        <h1>Usuarios</h1>
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Usuarios</li>
        </ul>

        @if ($showFullProfile && !$whitoutPerson)
        <div class="mt-3">
            <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
                <label class="form-control-addon-within rounded-full">
                    <input wire:model="search" type="text" class="form-control border-none" placeholder="Buscar por nombre y apellido">
                    <button type="button"
                        class="btn btn-link text-gray-300 dark:text-gray-700 dark:hover:text-primary text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                </label>
            </div>
        </div>
        @endif
        
    </section>

    <!--filtro-->
    <div class="card p-5">
        <div>
            <div class="grid lg:grid-cols-3 mt-3">
                <label class="switch">
                    <input wire:model="showFullProfile" type="checkbox" {{ ($whitoutPerson) ? 'disabled' : '' }}>
                    <span></span>
                    <span>Mostrar Usuarios con información completada</span>
                </label>
                <label class="switch">
                    <input wire:model="whitoutPerson" type="checkbox" {{ ($showFullProfile) ? 'disabled' : '' }}>
                    <span></span>
                    <span>Mostrar Usuarios sin información completada</span>
                </label>
            </div>
        </div>
        @if ($showFullProfile && !$whitoutPerson)
        <h3 class="mt-3">Filtros</h3>
        <div class="grid grid-cols-1">
            <!-- región comuna -->
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
        @endif
    </div> 

    <!-- Hoverable -->
    <div class="card p-5 mt-3">
        <h3>Usuarios</h3>
        <table class="table table_hoverable w-full mt-3">
            <thead>
                <tr>
                    <th class="ltr:text-left rtl:text-right uppercase">#</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Nombre y Apellidos</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Contacto</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Ubicación</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Tipo</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Creado</th>
                    <th class="ltr:text-left rtl:text-right uppercase"><!--acción--></th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td> <!-- nombre y apellidos -->
                            @if ($user->person)
                                {{ $user->person->name }} {{ $user->person->last_name }}
                            @else
                                {{ "@".$user->name }}
                            @endif
                        </td>
                        <td> <!-- contacto -->
                            <div>
                                @if ($user->person)
                                <div>
                                    <p>
                                        {{ $user->email }}
                                    </p>
                                    <p>
                                        @if ($user->person)
                                        {{ $user->person->phone }}
                                        @else
                                        Usuario no ha completado su informcación
                                        @endif
                                    </p>
                                </div>
                                @else
                                <div>
                                    {{ $user->email }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td><!-- ubicación -->
                            <div>
                                @if ($user->person)
                                <div>
                                    <p>
                                        {{ $user->person->city->region->name }}
                                    </p>
                                    <p>
                                        {{ $user->person->city->name }}
                                    </p>
                                </div>
                                @else
                                <div>
                                    Usuario no ha completado su informcación
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->createdAgo() }}</td>
                        <td>
                            <!-- accion -->
                            <div class="flex justify-end items-center">
                                @if ($user->person)
                                @if($user->person->features)
                                @if($user->person->transfer_account)
                                    <button class="btn btn-icon btn_outlined btn_info ltr:ml-2 rtl:mr-2" data-toggle="modal"
                                        data-target="#userModal{{ $user->person->id }}">
                                        <i class="las la-info"></i>
                                    </button>
                                    
                                    @if (count($user->person->photos)>0)
                                        <a href="{{ route('admin.users.photos',[ 'person'=>$user->person ]) }}" target="_blank" class="btn btn-icon btn_outlined btn_secondary ltr:ml-2 rtl:mr-2">
                                            <span class="las la-images"></span>
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.users.settings',['user'=>$user]) }}" class="btn btn-icon btn_outlined btn_warning ltr:ml-2 rtl:mr-2" >
                                        <i class="las la-user-cog"></i>
                                    </a>
                                @endif
                                @endif
                                @endif
                                @if ($user->role->key != 'admin')
                                <button wire:click="delete({{ $user->id }})" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2" >
                                    <span class="la la-trash-alt"></span>
                                </button>    
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($users as $user)    
        <!-- Basic -->
        @if ($user->person)
            @if($user->person->features)
                @if($user->person->transfer_account)
                <div id="userModal{{ $user->person->id }}" wire:ignore.self class="modal" data-animations="fadeInDown, fadeOutUp">
                    <div class="modal-dialog max-w-2xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title">Detalle Usuario {{ "@".$user->name }}</h2>
                                <button type="button" class="close la la-times" data-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Rut</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->rut }}</h4>
                                    </div>
                                </div>

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Nombre</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->name }}</h4>
                                    </div>
                                </div>

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Apellidos</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->last_name }}</h4>
                                    </div>
                                </div>
                                
                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Nacionalidad</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->country->demonym }}</h4>
                                    </div>
                                </div>

                            <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Género</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->gender }}</h4>
                                    </div>
                                </div>

                            <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Fecha de Nacimiento</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->getBirthDate() }}</h4>
                                        <h4>{{ $user->person->getAge()." años" }}</h4>
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
                                        <h4>{{ $user->email }}</h4>
                                    </div>
                                </div>
                            

                            <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Telefono</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->phone }}</h4>
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
                                        <h4>{{ $user->person->city->region->ordinal }} - {{ $user->person->city->region->name }}</h4>
                                    </div>
                                </div>
                            

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Comuna</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->city->name }}</h4>
                                    </div>
                                </div>
                                
                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Instagram</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->instagram }}</h4>
                                    </div>
                                </div>

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Profesión</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->profession }}</h4>
                                    </div>
                                </div>

                                <hr class="mt-3">
                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Color de Ojos</h4>
                                    </div>
                                    <div>
                                        <h4>Color de ojos</h4>
                                    </div>
                                </div>

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Color de Pelo</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->features->hair_color }}</h4>
                                    </div>
                                </div>

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Altura</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->features->height." cms" }}</h4>
                                    </div>
                                </div>

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Peso</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->features->weight." Kg" }}</h4>
                                    </div>
                                </div>

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Talla Polera</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->features->shirt_size }}</h4>
                                    </div>
                                </div>

                                <div class="grid lg:grid-cols-2 mt-3 gap-5">
                                    <div>
                                        <h4>Talla Pantalón</h4>
                                    </div>
                                    <div>
                                        <h4>{{ $user->person->features->pants_size }}</h4>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>            
                @endif
            @endif
        @endif
    @endforeach

    {{ $users->links('vendor.paginador') }}

</div>


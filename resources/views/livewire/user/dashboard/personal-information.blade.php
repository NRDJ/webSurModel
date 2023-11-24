<div>
    <form action="" wire:submit.prevent="update">
        <div class="grid lg:grid-cols-3 gap-5 mt-3">
            <div class="flex flex-col gap-y-5 lg:col-span-1">
                <div class="card p-5">
                    <h3>Datos Personales</h3>
                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">RUT *</div>
                        <input type="text" class="form-control input-group-item {{ $errors->has('rut') ? 'is-invalid' : '' }}" wire:model.defer="rut">
                    </div>
                    @error('rut') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Nombres *</div>
                        <input type="text" class="form-control input-group-item {{ $errors->has('name') ? 'is-invalid' : '' }}" wire:model.defer="name" placeholder="Nombres">
                        @error('name') 
                        <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Apellidos *</div>
                        <input type="text" class="form-control input-group-item {{ $errors->has('last_name') ? 'is-invalid' : '' }}" wire:model.defer="last_name" placeholder="Apellidos">
                        @error('last_name') 
                        <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Genero *</div>
                        <select wire:model.defer="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                            <option value="" selected>Seleccione una opción</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>
                    @error('gender') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Fecha de nacimiento *</div>
                        <label class="label block mb-2" for="input"></label>
                        <input wire:model.defer="birth_date" id="input" type="date" class="form-control {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" placeholder="Enter text here">
                        <small class="block mt-2"></small>
                    </div>
                    @error('birth_date') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Telefono *</div>
                        <div class="input-addon input-addon-prepend input-group-item">+56 9</div>
                        <input type="text" class="form-control input-group-item {{ $errors->has('phone') ? 'is-invalid' : '' }}" wire:model.defer="phone">
                    </div>
                    @error('phone') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Instagram @</div>
                        <input type="text" class="form-control input-group-item" wire:model.defer="instagram">
                    </div>
                    
                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Nacionalidad *</div>
                        <select wire:model.defer="country_id" class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}">
                            @foreach ($countries as $country)
                                <option class="lowercase" value="{{ $country->id }}" >
                                    {{ (($country->demonym)) }}
                                </option>
                            @endforeach
                        </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                        
                    </div>
                    @error('country_id') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Región</div>
                        <select wire:model.defer="region_id" wire:change="onChangeRegion($event.target.value)" class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}">
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }} - {{ $region->ordinal }}</option>
                            @endforeach
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>

                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Comuna</div>
                        <select wire:model.defer="city_id" class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}">
                            @if ($cities)
                                <option value="">-- Seleccionar --</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>
                    @error('city_id') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Profesión</div>
                        <input type="text" class="form-control input-group-item" wire:model.defer="profession">
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-5 lg:col-span-1">
                <div class="card p-5">
                    <h3>Rasgos Fisicos</h3>
                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Color de ojos</div>
                        <select wire:model.defer="eyes_color" class="form-control {{ $errors->has('eyes_color') ? 'is-invalid' : '' }}">
                            <option value="" selected>-- Seleccionar --</option>
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
                    @error('eyes_color') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item" >Color de Pelo</div>
                        <input type="text" maxlength="10" class="form-control input-group-item {{ $errors->has('hair_color') ? 'is-invalid' : '' }}" wire:model.defer="hair_color" >
                    </div>
                    @error('hair_color') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Altura</div>
                        <select wire:model.defer="height" class="form-control">
                            @for ($i = 90; $i < 221; $i++)
                                <option value="{{$i}}" >{{$i}} cms</option>  
                            @endfor  
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>

                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Peso</div>
                        <select wire:model.defer="weight" class="form-control">
                            @for ($i = 30; $i < 221; $i++)
                                <option value="{{$i}}" >{{$i}} kg</option>  
                            @endfor    
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>

                    {{-- <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item" >Talla Polera</div>
                        <input type="text" class="form-control input-group-item" wire:model.defer="shirt_size" >
                    </div> --}}
                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Talla Polera</div>
                        <select wire:model.defer="shirt_size" class="form-control {{ $errors->has('shirt_size') ? 'is-invalid' : '' }}">
                            <option value="" selected>-- Seleccionar --</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>
                    @error('shirt_size') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    {{-- <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item" >Talla Pantalon</div>
                        <input type="text" class="form-control input-group-item" wire:model.defer="pants_size" >
                    </div> --}}
                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Talla Pantalon</div>
                        <select wire:model.defer="pants_size" class="form-control {{ $errors->has('pants_size') ? 'is-invalid' : '' }}">
                            <option value="" selected>-- Seleccionar --</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>
                    @error('pants_size') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="card p-5">
                    <h3>Datos Bancarios</h3>
                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item" >Entidad Bancaria</div>
                        <input type="text" class="form-control input-group-item {{ $errors->has('bank') ? 'is-invalid' : '' }}" wire:model.defer="bank">
                    </div>
                    @error('bank') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="custom-select input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item">Tipo de cuenta</div>
                        <select wire:model="account_type" class="form-control {{ $errors->has('account_type') ? 'is-invalid' : '' }}">
                            <option value="" selected>Seleccione una opción</option>
                            <option value="Cuenta Corriente">Cuenta Corriente</option>  
                            <option value="Cuenta Vista">Cuenta Vista</option>  
                            <option value="Cuenta de Ahorro">Cuenta de Ahorro</option>  
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>
                    @error('account_type') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror

                    <div class="input-group mt-5">
                        <div class="input-addon input-addon-prepend input-group-item" >N° cuenta</div>
                        <input type="text"  class="form-control input-group-item {{ $errors->has('account_number') ? 'is-invalid' : '' }}" wire:model.defer="account_number">
                        {{-- <div class="input-addon input-addon-append input-group-item">.com</div> --}}
                    </div>
                    @error('account_number') 
                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col gap-y-5 lg:col-span-1">
                
            </div>

        </div>

        <div class="flex justify-center mt-5">
            <button type="submit" class="btn btn_primary uppercase">Actualizar antecedentes</button>
        </div>
    </form>        
    
</div>

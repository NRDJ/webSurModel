<div>

    <div class="card p-5 bg-sky-600">
        <div class="grid lg:grid-cols-4">
            <label class="custom-checkbox">
                <input type="checkbox" wire:model="filters.states.{{ "Activo" }}">
                <span></span>
                <span class="">Activo</span>
            </label>
                
            <label class="custom-checkbox">
                <input type="checkbox" wire:model="filters.states.{{ "Borrador" }}">
                <span></span>
                <span class="">Borrador</span>
            </label>

            <label class="custom-checkbox">
                <input type="checkbox" wire:model="filters.states.{{ "Finalizado" }}">
                <span></span>
                <span class="">Finalizado</span>
            </label>

            <label class="custom-checkbox">
                <input type="checkbox" wire:model="filters.states.{{ "Cancelado" }}">
                <span></span>
                <span class="">Cancelado</span>
            </label>
        </div>
        <div class="grid grid-cols-2 gap-2 mt-3">
            <div>
                <h4>Región</h4>
                <div class="custom-select">
                    <select wire:model.defer="region_id" wire:change="onChangeRegion($event.target.value)" class="form-control">
                        <option selected value="">Todas las regiones</option>
                        @foreach ($regiones as $r)
                            <option value="{{ $r->id }}" >
                                {{ $r->name }} - {{ $r->ordinal }}
                            </option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
            </div>

        </div>
    </div>


    <div class="card p-5 mt-5">
        <h3>Accordion</h3>
        @foreach ($regions as $region)
            @if ( count($events->whereIn('city_id',$region->cities->pluck('id') )) > 0 )
                <div class="accordion border border-divider rounded-xl mt-5">
                    <h5 class="p-5" data-toggle="collapse" data-target="#{{ "region_".$region->ordinal }}">
                        {{ $region->name }} - Cantidad: 
                        {{ count($events->whereIn('city_id',$region->cities->pluck('id') )) }}                        
                        <span class="collapse-indicator la la-arrow-circle-down"></span>
                    </h5>
                    <div id="{{ "region_".$region->ordinal }}" class="collapse {{ ($region->id == $region_id ) ? 'open' : '' }}">
                        <div class="p-5 pt-0">
                            <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5">

                                @foreach ($events as $event)
                                    @if ($event->city->region->id == $region->id)
                                        @livewire('admin.events.events-by-region', ['event' => $event], key('event_'.$event->id))
                                    @endif
                                @endforeach
                        
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>


    <br>

   

    <div class="mt-5">
        
    </div>
</div>

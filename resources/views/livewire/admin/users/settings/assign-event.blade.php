<div>
    <div class="card p-5">
        <h2>Asignar a evento</h2>
        <div class="grid lg:grid-cols-3 gap-5 mt-3">
            <div>
                <h3>Evento</h3>
                <div wire class="custom-select">
                    <select wire:change="onChangeEvent($event.target.value)" class="form-control">
                        <option value="">-- Seleccionar Evento --</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
            </div>
            <div>
                <h3>Publicación</h3>
                <div class="custom-select">
                    <select wire:model="publication_id" class="form-control">
                        <option value="" selected>-- Seleccionar Publicación --</option>
                        @if ($publications)
                        @foreach ($publications as $publication)
                            <option value="{{ $publication->id }}">{{ $publication->profile->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
            </div>
            {{-- <div class="grid lg:grid-cols-1 gap-5 mt-5 justify-center items-end"> --}}
                <button type="button" wire:click="assign" class="grid lg:grid-cols-1 gap-5 mt-5 justify-center items-end btn btn_primary uppercase">
                    Asignar
                </button>
            {{-- </div> --}}
        </div>
        <div class="grid lg:grid-cols-2 gap-5 mt-3 justify-center items-end">
            <div></div>

        </div>
    </div>
</div>

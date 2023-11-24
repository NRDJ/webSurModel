<div>
    {{-- <div class="card p-5 mt-3">
        <button wire:click="update" class="btn btn_primary uppercase">Guardar</button>
    </div> --}}
    <label class="custom-checkbox absolute top-0 ltr:left-0 rtl:right-0 mt-2 ltr:ml-2 rtl:mr-2" wire:ignore.self>
        <input type="checkbox" data-toggle="cardSelection" wire:model.defer="value" value="{{ $photo->id }}"
        wire:click="update({{ $photo->id}},{{$photo->confirmed }})" 
        >
        <span></span>
    </label>
    
</div>

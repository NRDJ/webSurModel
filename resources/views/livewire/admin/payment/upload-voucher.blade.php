<div>
    
    @if (!$payment->transfer_voucher)
    <div>
        <input wire:model.defer="voucher" class="form-control"  type="file" name="" id="{{ $identificador }}">
    </div>
    @error('voucher') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
    
    <div class="grid lg:grid-cols-1 justify-center items-center mt-3">
        @if ($voucher && !$payment->transfer_voucher)
            Vista previa:
            <iframe width="600" height="800" src="{{ $voucher->temporaryUrl() }}" frameborder="0"></iframe>
            {{-- <img src="{{ $logotipo->temporaryUrl() }}"> --}}
        @endif
    </div>
        <div class="grid lg:grid-cols-1 justify-center items-center mt-3">
            <button wire:click="upload" class="btn btn_outlined btn_primary uppercase mt-3">Subir</button>
        </div>
    @else
        <div class="grid lg:grid-cols-1 justify-center items-center mt-3">
            <button wire:click="delete" class="btn btn_outlined btn_danger uppercase mt-3">Eliminar</button>
        </div>
    @endif


    @if ($payment->transfer_voucher)
    <div class="grid lg:grid-cols-1 justify-center items-center mt-5">
        <span class="ml-2 flex-1 w-0 truncate">
            <iframe width="600" height="800" src="{{ route('accessVoucher',['id_publication'=>$publication->id,'id_user'=>$person->user->id,$payment->transfer_voucher]) }}" frameborder="0"></iframe>
        </span>
    </div>
        
    @endif
    
</div>

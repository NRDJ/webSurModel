<div>
    <div class="row text-white">
                            
        <div class="col-12 col-md-12 form-floating mb-4">
            <input type="text" class="form-control" wire:model.defer="empresa" placeholder="Empresa o Marca">
            <label for="empresa">Empresa o Marca</label>
            @error('empresa') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 col-md-12 form-floating mb-4">
            <input type="text" class="form-control" wire:model.defer="nombre" placeholder="Nombre contacto">
            <label for="nombre">Nombre</label>
            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
                            
        <div class="col-12 col-md-6 form-floating mb-4">
            <input type="email" class="form-control" wire:model.defer="correo" placeholder="Correo">
            <label for="correo">Correo</label>
            @error('correo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
                            
        <div class="col-12 col-md-6 form-floating mb-4">
            <input type="email" class="form-control" wire:model.defer="telefono" placeholder="Teléfono">
            <label for="telefono">Teléfono</label>
            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-12 form-floating mb-4">
            <textarea  rows="10" class="form-control" wire:model.defer="mensaje" placeholder="Mensale" style="resize: none"></textarea>
            <label for="mensaje">Mensaje</label>
            @error('mensaje') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
                        
    <button wire:click="sendMessage" class="btn_gral mt-4">Enviar</button>
</div>

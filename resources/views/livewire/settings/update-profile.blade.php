<div>

    <div class="grid lg:grid-cols-3 gap-5">
        <form class="card p-5" wire:submit.prevent="updateEmail">
            <h3>Actualizar Correo</h3>
            <div class="relative mt-5">
                <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="input-2">Correo actual</label>
                <input id="input-2" type="email" class="form-control mt-2 pt-5" placeholder="Introducir correo aquí" disabled value="{{ $email }}">
            </div>
            <div class="relative mt-5">
                <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="input-2">Nuevo Correo</label>
                <input id="input-2" type="email" class="form-control mt-2 pt-5 {{ $errors->has('new_email') ? 'is-invalid' : '' }}" placeholder="Introducir correo aquí" wire:model.defer="new_email">
                @error('new_email') 
                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-5 grid lg:grid-cols-1 justify-center items-center">
                <button type="submit" class="btn btn_primary uppercase">Actualizar</button>
            </div>
        </form>
        <form class="card p-5" wire:submit.prevent="updatePassword">
            <h3>Actualizar contraseña</h3>
            <div class="relative mt-5">
                <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="input-2">Contraseña actual</label>
                <input id="input-2" type="password" class="form-control mt-2 pt-5 {{ $errors->has('current_password') ? 'is-invalid' : '' }}" placeholder="Introducir contraseña aquí" wire:model.defer="current_password">
                @error('current_password') 
                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="relative mt-5">
                <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="input-2">Nueva Contraseña</label>
                <input id="input-2" type="password" class="form-control mt-2 pt-5 {{ $errors->has('new_password') ? 'is-invalid' : '' }} {{ $errors->has('new_confirm_password') ? 'is-invalid' : '' }}" placeholder="Introducir contraseña aquí" wire:model.defer="new_password">
                @error('new_password') 
                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="relative mt-5">
                <label
                    class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                    for="input-2">Confirmar Nueva Contraseña</label>
                <input id="input-2" type="password" class="form-control mt-2 pt-5 {{ $errors->has('new_confirm_password') ? 'is-invalid' : '' }}" placeholder="Introducir contraseña aquí" wire:model.defer="new_confirm_password">
                @error('new_confirm_password') 
                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-5 grid lg:grid-cols-1 justify-center items-center">
                <button type="submit" class="btn btn_primary uppercase">Actualizar</button>
            </div>
        </form>
    </div>


    {{-- <form method="POST" action="{{ route('change.password') }}">
        @csrf 

        <div class="form-group row">

            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>



            <div class="col-md-6">

                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">

            </div>

        </div>



        <div class="form-group row">

            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>



            <div class="col-md-6">

                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">

            </div>

        </div>



        <div class="form-group row">

            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>



            <div class="col-md-6">

                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">

            </div>

        </div>



        <div class="form-group row mb-0">

            <div class="col-md-8 offset-md-4">

                <button type="submit" class="btn btn-primary">

                    Update Password

                </button>

            </div>

        </div>
    </form> --}}
</div>

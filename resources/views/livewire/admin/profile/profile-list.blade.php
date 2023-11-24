<div>
    <!-- Hoverable -->
    <div class="card p-5 mt-3">
        <h3>Perfiles</h3>
        <table class="table table_hoverable w-full mt-3">
            <thead>
                <tr>
                    <th class="ltr:text-left rtl:text-right uppercase">#</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Nombre</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Descripcion</th>
                    <th class="ltr:text-right rtl:text-right uppercase"></th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $profile->name }}</td>
                        <td>{{ $profile->description }}</td>
                        <td>
                            <div class="flex justify-end items-center">
                                @livewire('admin.profile.profile-edit', ['profile' => $profile], key('profile_'.$profile->id))
                                <button wire:click="delete({{ $profile->id }})" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2" >
                                    <span class="la la-trash-alt"></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
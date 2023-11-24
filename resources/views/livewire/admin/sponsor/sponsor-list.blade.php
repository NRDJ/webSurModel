<div>
    <div class="card p-5">
        <div class="grid lg:grid-cols-1">
            <input type="text" class="form-control" wire:model="search" placeholder="Buscar por nombre de contacto">
        </div>
    </div>
    <!-- Hoverable -->
    <div class="card p-5 mt-3">
        <h3>Hoverable</h3>
        <table class="table table_hoverable w-full mt-3">
            <thead>
                <tr>
                    <th class="ltr:text-left rtl:text-right uppercase">#</th>
                    <th class="ltr:text-left rtl:text-right uppercase"></th>
                    <th class="ltr:text-left rtl:text-right uppercase">RUT</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Nombre de contacto</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Razón Social</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Giro Principal</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Dirección</th>
                    <th class="ltr:text-left rtl:text-right uppercase">Telefono</th>
                    <th class="ltr:text-right rtl:text-right uppercase"></th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($sponsors as $sponsor)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            <div class="image">
                                @if ($sponsor->logo)
                                    <img src="{{ route('sponsor.image',['image'=>$sponsor->logo]) }}" class="avatar w-16 h-16">
                                @else
                                    <img src="{{ asset('img/no-image.jpg') }}" class="avatar w-16 h-16">
                                @endif
                            </div>
                        </td>
                        <td>{{ $sponsor->rut }}</td>
                        <td>{{ $sponsor->contact_name }}</td>
                        <td>{{ $sponsor->business_name }}</td>
                        <td>{{ $sponsor->main_line }}</td>
                        <td>{{ $sponsor->commercial_address }}</td>
                        <td>{{ $sponsor->contact_phone }}</td>
                        <td>
                            <div class="flex justify-end items-center">
                                @livewire('admin.sponsor.sponsor-edit', ['sponsor' => $sponsor], key('sponsor_'.$sponsor->id))
                                <button wire:click="delete({{ $sponsor->id }})" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2" >
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
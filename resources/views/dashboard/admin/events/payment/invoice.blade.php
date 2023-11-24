@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')

        <!-- Workspace -->
        <main class="workspace">

            <!-- Breadcrumb -->
            <section class="breadcrumb lg:flex items-start">
                <div>
                    <h1>Boleta</h1>
                    <ul>
                        <li><a href="#">Eventos</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">{{ $publication->event->name }}</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">{{ $publication->profile->name }}</a></li>
                        <li class="divider la la-arrow-right"></li>
                        <li><a href="#">{{ $person->name }}  {{ $person->last_name }}</a></li>
                    </ul>
                </div>
            </section>

            <div class="card p-5">
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Evento</h4>
                    </div>
                    <div>
                        <h4>{{ $publication->event->name }} {{ $publication->profile->name }}</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Usuario</h4>
                    </div>
                    <div>
                        <h4>{{ $person->name }} {{ $person->last_name }}</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Rut</h4>
                    </div>
                    <div>
                        <h4>{{ $person->rut }}</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Contacto</h4>
                    </div>
                    <div>
                        <h4>Email: {{ $person->user->email }}</h4>
                        <h4>Telefono: {{ $person->phone }}</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Pago antes del {{ \Carbon\Carbon::parse($publication->event->end_date)->addDays(40)->format('d M') }}</h4>
                    </div>
                    <div>
                        <h4>{{ $payment->discount }}</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Remuneración</h4>
                    </div>
                    <div>
                        <h4>${{ $publication->remuneration }}</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Remuneración total</h4>
                    </div>
                    <div>
                        <h4>${{ ($publication->remuneration) - ($publication->remuneration)*0.1  }}</h4>
                    </div>
                </div>
                <div class="mt-3">
                    <hr>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Datos para transferencia</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Institución Bancaria</h4>
                    </div>
                    <div>
                        <h4>{{ $person->transfer_account->bank }}</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Tipo de cuenta</h4>
                    </div>
                    <div>
                        <h4>{{ $person->transfer_account->account_type }}</h4>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 mt-3">
                    <div>
                        <h4>Numero de cuenta</h4>
                    </div>
                    <div>
                        <h4>{{ $person->transfer_account->account_number }}</h4>
                    </div>
                </div>
                <hr class="mt-3">
                <div class="mt-3">
                    <div class="grid lg:grid-cols-1 justify-center items-center gap-5">
                        <h3>Boleta</h3>
                        <div class="mt-1">
                            <span class="ml-2 flex-1 w-0 truncate">
                                <iframe width="600" height="800" src="{{ route('accessHonoraryTicket',['id_publication'=>$publication->id,'id_user'=>$person->user->id,$payment->honorary_ticket]) }}" frameborder="0"></iframe>
                            </span>
                        </div>
                    </div>
                </div>
                <hr class="mt-3">


                <div class="grid lg:grid-cols-1 justify-center items-center gap-5 mt-3">
                    <h3>Comprobante de transferencia</h3>
                    <div>
                        @livewire('admin.payment.upload-voucher', [ 'publication' => $publication, 'payment' => $payment,'person' => $person])
                    </div>
                </div>

                @if ($payment->transfer_voucher)
                <div class="grid lg:grid-cols-1 justify-center items-center gap-5 mt-3">
                    @livewire('admin.payment.send-voucher', [ 'publication' => $publication, 'payment' => $payment,'person' => $person])
                </div>                    
                @endif


            </div>
            
            {{-- {{ route('accessHonoraryTicket',['id_publication'=>$publication->id,'id_user'=>$person->id,$payment->honorary_ticket]) }} --}}

            @include('layouts.yeti.footer')
    
        </main>

@endsection
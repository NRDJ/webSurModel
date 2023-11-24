@extends('layouts.yeti.background')

@section('content')
    @include('layouts.yeti.navigation')
    {{-- @include('layouts.yeti.customizer') <!--cambiar color --> --}}

    <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Evento</h1>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li><a href="#">Evento</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>{{ $publication->event->name }} - {{ $publication->profile->name }}</li>
                </ul>
            </div>
        </section>

        <!-- List -->
        <div class="grid lg:grid-cols-2 gap-5">
            <div class="card p-5">
                <h3>Boleta enviada</h3>
                <div class="grid lg:grid-cols-1 justify-center items-center mt-5">
                    @if ($payment->honorary_ticket)
                        <iframe width="600" height="800" src="{{ route('accessHonoraryTicket',['id_publication'=>$publication->id,'id_user'=>$person->user->id,$payment->honorary_ticket]) }}" frameborder="0"></iframe>
                        {{-- <img src="{{ $logotipo->temporaryUrl() }}"> --}}
                    @endif
                </div>
            </div>
            <div class="card p-5">
                <h3>Comprobante de transferencia</h3>
                <div class="grid lg:grid-cols-1 justify-center items-center mt-5">
                    @if ($payment->transfer_voucher)
                        <iframe width="600" height="800" src="{{ route('accessVoucher',['id_publication'=>$publication->id,'id_user'=>$person->user->id,$payment->transfer_voucher]) }}" frameborder="0"></iframe>
                        {{-- <img src="{{ $logotipo->temporaryUrl() }}"> --}}
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-5">
            {{-- @@include("partials/_pagination.html") --}}
        </div>

        @include('layouts.yeti.footer')

    </main>


@endsection
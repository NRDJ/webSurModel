<div>
    <div class="grid lg:grid-cols-1 justify-center items-center mt-3">
        <button wire:click="sendMailVoucher" class="card px-4 py-4 flex justify-center items-center text-center btn btn_outlined btn_primary uppercase mt-3" data-toggle="tooltip" data-tippy-content="Enviar Comprobante al email del usuario {{ $person->name }} {{ $person->last_name }} ">
            <h1><span class="icon las la-envelope-open-text"></span></h1>
        </button>
    </div>
</div>

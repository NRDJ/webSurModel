<div>
    <div class="card card_column card_hoverable">
        <div class="image">
            <div class="aspect-w-4 aspect-h-3">
                @if ($event->path_image)
                    <img src="{{ route('event.image',['image'=>$event->path_image]) }}">
                @elseif($event->sponsor->logo)
                    <img src="{{ route('sponsor.image',['image'=>$event->sponsor->logo]) }}">
                @else
                    <img src="{{ asset('img/no-image.jpg') }}">
                @endif
            </div>
            <label class="custom-checkbox absolute top-0 ltr:left-0 rtl:right-0 mt-2 ltr:ml-2 rtl:mr-2">
                <input type="checkbox" data-toggle="cardSelection">
                <span></span>
            </label>
            <div
                class="badge badge_outlined badge_secondary uppercase absolute top-0 ltr:right-0 rtl:left-0 mt-2 ltr:mr-2 rtl:ml-2">
                {{ $event->state }}</div>
        </div>
        <div class="header">
            <h5>{{ $event->name }}</h5>
            <hr class="mt-3">
            <h6 class="uppercase mt-3">Detalle</h6>
            <p>{{ $event->description }}</p>
        </div>
        <div class="body">
            <h6 class="uppercase">Fechas</h6>
            <p>{{ $event->getStartDate() }} - {{ $event->getDateEnd() }}</p>
        </div>
        <div class="actions">
            @livewire('admin.events.events-edit', ['event' => $event], key('event_'.$event->id))
            <button class="btn btn-icon btn_outlined btn_info ltr:ml-2 rtl:mr-2"><a href="{{ route('admin.events.publications',['slug'=>$event->slug]) }}"><span class="lab la-wpforms"></span></a></button>
            <button class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2" wire:click="delete({{ $event->id }})"><span class="la la-trash-alt"></span></button>
            <div class="dropdown ltr:ml-auto rtl:mr-auto ltr:-mr-3 rtl:-ml-3">
                <button class="btn-link" data-toggle="dropdown-menu">
                    <span class="la la-ellipsis-v text-4xl leading-none"></span>
                </button>
                <div class="dropdown-menu">
                    <a href="#">Dropdown Action</a>
                    <a href="#">Link</a>
                    <hr>
                    <a href="#">Something Else</a>
                </div>
            </div>
        </div>
    </div>
</div>

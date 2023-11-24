{{-- <div>
    hola
</div> --}}

<div class="px-2">
    @if ($person->person_request()->where('publication_id',$publication->id)->first()->pivot->state == 'Pendiente')
        <button wire:click="selectUSer" title="Seleccionar usuario" class="badge badge_secondary uppercase">
            {{ $person->person_request()->where('publication_id',$publication->id)->first()->pivot->state }}
        </button>
    @elseif ($person->person_request()->where('publication_id',$publication->id)->first()->pivot->state == 'Preseleccionado')
        <button wire:click="unselectUser" title="Colocar estado pendiente" class="badge badge_warning uppercase">
            {{ $person->person_request()->where('publication_id',$publication->id)->first()->pivot->state }}
        </button>
    @elseif ($person->person_request()->where('publication_id',$publication->id)->first()->pivot->state == 'Seleccionado')
        <button title="" class="badge badge_success uppercase">
            {{ $person->person_request()->where('publication_id',$publication->id)->first()->pivot->state }}
        </button>
    @elseif ($person->person_request()->where('publication_id',$publication->id)->first()->pivot->state == 'Confirmado')
        <button title="" class="badge badge_primary uppercase">
            {{ $person->person_request()->where('publication_id',$publication->id)->first()->pivot->state }}
        </button>
    @elseif ($person->person_request()->where('publication_id',$publication->id)->first()->pivot->state == 'Rechazado')
        <button title="" class="badge badge_danger uppercase">
            {{ $person->person_request()->where('publication_id',$publication->id)->first()->pivot->state }}
        </button>
    @endif
</div>

{{-- 
<td class="text-center">
    <div class="badge badge_outlined badge_warning uppercase">Draft</div>
</td>

<td class="text-center">
    <div class="badge badge_outlined badge_success uppercase">Published</div>
</td>

<td class="text-center">
    <div class="badge badge_outlined badge_secondary uppercase">Draft</div>
</td> --}}
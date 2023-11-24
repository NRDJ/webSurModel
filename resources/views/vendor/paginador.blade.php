@if ($paginator->hasPages())
<div class="mt-3">
    <div class="card lg:flex">
        <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-wrap gap-2 p-5">
            
            @if ($paginator->onFirstPage())
                <span class="btn btn_secondary">Anterior</span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="btn btn_primary">
                    Anterior
                </button> 
            @endif
        
            @foreach ($elements as $element)
                @if (is_string($element))
                    <button class="btn btn_outlined btn_secondary">{{ $element }}</button>
                @endif
            
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                        <button class="btn btn_primary" wire:click="gotoPage({{$page}})">{{ $page }}</button>
                        @else
                        <button class="btn btn_outlined btn_secondary" wire:click="gotoPage({{$page}})">{{ $page }}</button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="btn btn_primary">
                    Siguiente
                </button>
            @else
                <span class="btn btn_secondary">Siguiente</span>
            @endif
            
        </nav>  
        <div class="flex items-center ltr:ml-auto rtl:mr-auto p-5 border-t lg:border-t-0 border-divider">
            Mostrando {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} de {{ $paginator->total() }} 
        </div>
    </div>
</div>
@endif
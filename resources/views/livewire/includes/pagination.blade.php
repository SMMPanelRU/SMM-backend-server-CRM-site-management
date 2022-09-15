<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">

    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

    <div class="col-sm-12 col-md-5 mt-2">
        {{ucfirst(__('pagination.showing'))}} {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} {{__('pagination.of')}} {{ $paginator->total() }}
    </div>
    <div class="col-sm-12 col-md-7">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end mt-2">

                @if (!$paginator->onFirstPage())
                    <li class="page-item">
                        <button class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                           dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before">
                            <i class="fas fa-chevron-double-left"></i>
                        </button>
                    </li>
                @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled">{{ $element }}</li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <li class="page-item @if ($page == $paginator->currentPage()) active @endif">
                                    <button class="page-link" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">
                                        {{ $page }}
                                    </button>
                                </li>


                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <button class="page-link" href="#" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                               dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after">
                                <i class="fas fa-chevron-double-right"></i>
                            </button>
                        </li>

                    @endif

            </ul>
        </nav>
    </div>
    @endif
</div>


@if ($paginator->hasPages())
    <div class="flex flex-col justify-center w-full mt-5">
        <ul class="inline-flex items-center m-auto space-x-1 rtl:space-x-reverse">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <button type="button"
                            class="flex justify-center items-center rounded border-2 border-[#e0e6ed] px-3.5 py-2 font-semibold text-gray-400 cursor-not-allowed dark:border-[#191e3a] dark:text-gray-600">
                        قبلی
                    </button>
                </li>
            @else
                <li>
                    <button type="button"
                            wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            class="flex justify-center items-center rounded border-2 border-[#e0e6ed] px-3.5 py-2 font-semibold text-dark transition hover:border-primary hover:text-primary dark:border-[#191e3a] dark:text-white-light dark:hover:border-primary">
                        قبلی
                        <span wire:loading wire:target="previousPage('{{ $paginator->getPageName() }}')" class="ml-2">
                            ⏳
                        </span>
                    </button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span
                            class="flex justify-center items-center rounded border-2 border-[#e0e6ed] px-3.5 py-2 font-semibold text-gray-400 dark:border-[#191e3a] dark:text-gray-500">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <button type="button"
                                        class="flex justify-center items-center rounded border-2 border-primary px-3.5 py-2 font-semibold text-primary transition dark:border-primary dark:text-white-light">
                                    {{ $page }}
                                </button>
                            </li>
                        @else
                            <li>
                                <button type="button"
                                        wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                        wire:loading.attr="disabled"
                                        class="flex justify-center items-center rounded border-2 border-[#e0e6ed] px-3.5 py-2 font-semibold text-dark transition hover:border-primary hover:text-primary dark:border-[#191e3a] dark:text-white-light dark:hover:border-primary">
                                    {{ $page }}
                                    <span wire:loading wire:target="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" class="ml-2">
                                        ⏳
                                    </span>
                                </button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <button type="button"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            class="flex justify-center items-center rounded border-2 border-[#e0e6ed] px-3.5 py-2 font-semibold text-dark transition hover:border-primary hover:text-primary dark:border-[#191e3a] dark:text-white-light dark:hover:border-primary">
                        بعدی
                        <span wire:loading wire:target="nextPage('{{ $paginator->getPageName() }}')" class="ml-2">
                            ⏳
                        </span>
                    </button>
                </li>
            @else
                <li>
                    <button type="button"
                            class="flex justify-center items-center rounded border-2 border-[#e0e6ed] px-3.5 py-2 font-semibold text-gray-400 cursor-not-allowed dark:border-[#191e3a] dark:text-gray-600">
                        بعدی
                    </button>
                </li>
            @endif

        </ul>
    </div>
@endif

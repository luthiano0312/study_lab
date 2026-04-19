@props([
    'href'    => '#',
    'active'  => false,
    'label'   => '',
    'icon'    => '',
    'submenu' => [],
])

@php $hasSubmenu = count($submenu) > 0; @endphp

<div class="relative group/item">

    {{-- Item Principal --}}
    <a href="{{ $href }}"
       class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-semibold
              transition-all duration-200 whitespace-nowrap overflow-hidden
              {{ $active
                ? 'bg-gradient-to-r from-pink-500/15 to-pink-400/5 text-pink-600 dark:text-pink-400 shadow-sm'
                : 'text-gray-500 hover:bg-pink-50/80 hover:text-pink-600 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-pink-400' }}">

        {{-- Active left bar --}}
        @if($active)
            <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-5 bg-gradient-to-b from-pink-500 to-pink-300 rounded-r-full shadow-[0_0_8px_rgba(236,72,153,.6)]"></span>
        @endif

        {{-- Icon --}}
        <span class="shrink-0 w-5 h-5 flex items-center justify-center">
            <img src="{{ asset('favicons/' . $icon) }}" alt="{{ $label }}"
                 class="h-[18px] w-[18px] shrink-0 transition-all duration-200
                        {{ $active ? 'opacity-100' : 'opacity-40 group-hover/item:opacity-90' }}
                        dark:filter-[invert(43%)_sepia(94%)_saturate(2250%)_hue-rotate(306deg)_brightness(96%)_contrast(97%)]">
        </span>

        {{-- Label --}}
        <span class="overflow-hidden max-w-0 opacity-0 leading-none
                     group-hover/sidebar:max-w-[160px] group-hover/sidebar:opacity-100
                     transition-all duration-300 ease-in-out">
            {{ $label }}
        </span>

        {{-- Chevron for submenu --}}
        @if($hasSubmenu)
            <svg class="ml-auto w-3 h-3 shrink-0 opacity-0 group-hover/sidebar:opacity-40 transition-opacity duration-300"
                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        @endif
    </a>

    @if($hasSubmenu)
    {{-- Hover bridge so mouse can travel to submenu --}}
    <div class="absolute left-full top-0 h-full w-4 opacity-0 pointer-events-none
                group-hover/item:pointer-events-auto"></div>

    {{-- Submenu panel --}}
    <div class="absolute left-[calc(100%+16px)] top-1/2 -translate-y-1/2 z-50
                pointer-events-none opacity-0 translate-x-2 scale-[.97]
                group-hover/item:pointer-events-auto group-hover/item:opacity-100
                group-hover/item:translate-x-0 group-hover/item:scale-100
                transition-all duration-200 ease-out origin-left">

        {{-- Arrow nub --}}
        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5
                    bg-white border-l border-t border-gray-100
                    dark:bg-[#1c1c28] dark:border-white/8 -rotate-45 shadow-[-2px_-2px_4px_rgba(0,0,0,.04)]"></div>

        {{-- Panel --}}
        <div class="bg-white/95 backdrop-blur-xl border border-gray-100/80 shadow-xl shadow-black/8
                    dark:bg-[#1c1c28]/95 dark:border-white/8 dark:shadow-black/60
                    rounded-2xl p-2 min-w-[190px]">

            {{-- Section label --}}
            <p class="text-[9px] font-black text-gray-300 dark:text-slate-600 uppercase tracking-[.22em] px-3 py-1.5 mb-0.5">
                {{ $label }}
            </p>

            <ul class="flex flex-col gap-0.5">
                @foreach($submenu as $item)
                <li>
                    <a href="{{ $item['href'] }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-[12.5px] font-semibold
                              text-gray-600 hover:bg-pink-50 hover:text-pink-600
                              dark:text-slate-300 dark:hover:bg-pink-500/10 dark:hover:text-pink-400
                              transition-all duration-150 whitespace-nowrap group/sub">

                        @if(!empty($item['icon']))
                            <img src="{{ asset('favicons/' . $item['icon']) }}"
                                 class="h-3.5 w-3.5 opacity-40 group-hover/sub:opacity-100 transition-opacity
                                        dark:filter-[invert(43%)_sepia(94%)_saturate(2250%)_hue-rotate(306deg)_brightness(96%)_contrast(97%)]"
                                 alt="">
                        @endif
                        {{ $item['label'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

</div>
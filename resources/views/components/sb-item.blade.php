@props([
    'href'    => '#',
    'active'  => false,
    'label'   => '',
    'icon'    => '',
    'submenu' => [],
])

@php $hasSubmenu = count($submenu) > 0; @endphp

<div class="relative group/item">

    <a href="{{ $href }}"
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-[13px]
              transition-all duration-200 whitespace-nowrap
              {{ $active ? 'bg-pink-50 text-pink-600 shadow-sm' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-600' }}">

        <img src="{{ asset('favicons/' . $icon) }}" alt="{{ $label }}"
             class="h-4 w-4 flex-shrink-0 transition-opacity duration-200
                    {{ $active ? 'opacity-80' : 'opacity-50 group-hover/item:opacity-80' }}">

        <span class="overflow-hidden max-w-0 opacity-0
                     group-hover/sidebar:max-w-[160px] group-hover/sidebar:opacity-100
                     transition-all duration-300 ease-in-out">
            {{ $label }}
        </span>

        @if($active)
            <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-5 bg-pink-500 rounded-r-full"></span>
        @endif
    </a>

    @if($hasSubmenu)

    <div class="absolute left-full top-0 h-full w-[14px] opacity-0 pointer-events-none
                group-hover/item:pointer-events-auto"></div>


    <div class="absolute left-[calc(100%+14px)] top-1/2 -translate-y-1/2 z-50
                pointer-events-none opacity-0 translate-x-1
                group-hover/item:pointer-events-auto group-hover/item:opacity-100 group-hover/item:translate-x-0
                transition-all duration-150 ease-out">


        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5
                    bg-white border-l border-t border-gray-100 rotate-[-45deg]"></div>


        <div class="bg-white rounded-xl border border-gray-100 shadow-lg shadow-pink-100/50 p-2 min-w-[180px]">
            <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest px-3 py-1.5">{{ $label }}</p>
            <ul class="flex flex-col gap-0.5">
                @foreach($submenu as $item)
                <li>
                    <a href="{{ $item['href'] }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-[13px] font-semibold
                              text-gray-600 hover:bg-pink-50 hover:text-pink-600
                              transition-colors duration-100 whitespace-nowrap">
                        @if(!empty($item['icon']))
                            <img src="{{ asset('favicons/' . $item['icon']) }}" class="h-3.5 w-3.5 opacity-50" alt="">
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
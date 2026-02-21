@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1  text-sm font-medium leading-5 text-white transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-transparent text-sm font-medium leading-5 text-white hover:bg-[#121212]  ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

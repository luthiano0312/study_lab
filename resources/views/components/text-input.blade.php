@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border h-8 focus:border-indigo-500 focus:ring-indigo-500 p-2 shadow-sm']) }}>

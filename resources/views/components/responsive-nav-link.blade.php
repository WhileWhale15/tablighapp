@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2 text-sm font-medium text-white bg-gray-700 rounded-lg'
            : 'block w-full px-4 py-2 text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

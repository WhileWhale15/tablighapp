@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'flex items-center px-4 py-2 text-md font-medium text-white bg-gray-700 rounded-lg'
        : 'flex items-center px-4 py-2 text-md font-medium text-gray-400 hover:text-white rounded-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

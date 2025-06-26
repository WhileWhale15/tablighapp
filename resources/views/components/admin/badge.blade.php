@props(['status' => 'active'])

@php
    $colors = [
        'active' => 'bg-[#24937E] text-white',
        'inactive' => 'bg-gray-400 text-white',
        'danger' => 'bg-red-600 text-white',
    ];
@endphp

<span {{ $attributes->merge(['class' => "px-2 py-1 rounded text-xs {$colors[$status]}"]) }}>
    {{ $slot }}
</span>

@props(['color' => 'primary', 'type' => 'button'])

@php
    $base = 'font-semibold px-4 py-2 rounded transition focus:outline-none';
    $colors = [
        'primary' => 'bg-[#24937E] hover:bg-[#0E5D4E] text-white',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
        'secondary' => 'bg-gray-400 hover:bg-gray-500 text-white',
        'warning' => 'bg-yellow-400 hover:bg-yellow-500 text-white',
    ];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$base {$colors[$color]}"]) }}>
    {{ $slot }}
</button>

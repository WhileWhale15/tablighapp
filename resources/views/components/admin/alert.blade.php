@props(['type' => 'success'])

@php
    $colors = [
        'success' => 'bg-[#24937E] text-white',
        'danger' => 'bg-red-600 text-white',
        'warning' => 'bg-yellow-400 text-white',
    ];
@endphp

<div {{ $attributes->merge(['class' => "p-4 rounded mb-4 {$colors[$type]}"]) }}>
    {{ $slot }}
</div>

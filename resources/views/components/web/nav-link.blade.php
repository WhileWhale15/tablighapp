@props(['href'])

<a href="{{ $href }}" {{ $attributes->merge([
    'class' => 'rounded-lg font-medium hover:text-purple-600 transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</a>

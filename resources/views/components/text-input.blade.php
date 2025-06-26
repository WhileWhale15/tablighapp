@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#24937E] focus:ring-[#24937E] rounded-md shadow-sm']) }}>

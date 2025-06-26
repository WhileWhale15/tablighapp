<div class="relative">
    <label class="sr-only" for="{{ $id }}">{{ $placeholder }}</label>
    <input type="text" id="{{ $id }}" onkeyup="{{ $onkeyup }}"
        class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500"
        placeholder="{{ $placeholder }}" />
    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
        <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
        </svg>
    </div>
</div>

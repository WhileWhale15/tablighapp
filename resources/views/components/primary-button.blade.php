<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-[#24937E] border border-transparent rounded-md font-semibold text-md text-white tracking-wide hover:bg-[#0E5D4E] focus:bg-[#0E5D4E] active:bg-[#040404] focus:outline-none focus:ring-2 focus:ring-[#24937E] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

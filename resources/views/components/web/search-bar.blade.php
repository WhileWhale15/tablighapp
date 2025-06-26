@props(['placeholder' => 'Cari data...'])

<div
    class="relative w-full max-w-xl bg-gray-100 rounded-2xl shadow-md p-1.5 transition-all duration-150 ease-in-out hover:scale-105 hover:shadow-lg">
    <form action="{{ route('search.results') }}" method="GET" class="flex items-center">
        <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <input type="text" name="query" value="{{ request('query') }}" placeholder="{{ $placeholder }}"
            class="w-full pl-8 pr-24 py-3 text-base text-gray-700 bg-transparent border-0 border-[#24937E] rounded-xl focus:outline-none" />
        <button type="submit"
            class="absolute right-1 top-1 bottom-1 px-12 bg-[#24937E] text-white font-medium rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#24937E] hover:bg-[#0E5D4E] transition duration-150 ease-in-out">
            Cari
        </button>
    </form>
</div>

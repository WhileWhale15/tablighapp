<x-website-layout>
    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto py-6 sm:px-4">
        <x-web.breadcrumb :items="[
        ['label' => 'Direktori', 'url' => route('user.direktori')],
    ]" />
    </div>

    <!-- Directory Cards -->
    <div class="max-w-6xl mx-auto mb-12 sm:px-4">
        <h1 class="py-3 text-4xl font-semibold text-gray-800">Direktori Komunitas</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8">
            <!-- Masjid Card -->
            <a href="{{ route('user.mesjid') }}"
                class="group block rounded-xl bg-white shadow-md hover:shadow-lg transition p-6 border border-gray-100 hover:border-[#24937E]">
                <div class="flex items-center gap-3 mb-4">
                    <img src="/Logo.png" alt="Masjid" class="h-10 w-10 rounded-full object-cover bg-gray-100">
                    <span class="text-lg font-bold text-[#24937E]">Masjid</span>
                </div>
                <div class="font-semibold text-gray-900 text-xl mb-1">Direktori Masjid</div>
                <div class="text-gray-500">Lihat daftar masjid di wilayah Anda.</div>
                <div class="flex justify-end mt-4">
                    <svg class="w-6 h-6 text-[#24937E] group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            <!-- Kelurahan Card -->
            <a href="{{ route('user.kelurahan') }}"
                class="group block rounded-xl bg-white shadow-md hover:shadow-lg transition p-6 border border-gray-100 hover:border-[#24937E]">
                <div class="flex items-center gap-3 mb-4">
                    <img src="/Logo.png" alt="Kelurahan" class="h-10 w-10 rounded-full object-cover bg-gray-100">
                    <span class="text-lg font-bold text-[#24937E]">Kelurahan</span>
                </div>
                <div class="font-semibold text-gray-900 text-xl mb-1">Direktori Kelurahan</div>
                <div class="text-gray-500">Lihat daftar kelurahan di wilayah Anda.</div>
                <div class="flex justify-end mt-4">
                    <svg class="w-6 h-6 text-[#24937E] group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            <!-- Jamaah Card -->
            <a href="{{ route('user.jemaah') }}"
                class="group block rounded-xl bg-white shadow-md hover:shadow-lg transition p-6 border border-gray-100 hover:border-[#24937E]">
                <div class="flex items-center gap-3 mb-4">
                    <img src="/Logo.png" alt="Jamaah" class="h-10 w-10 rounded-full object-cover bg-gray-100">
                    <span class="text-lg font-bold text-[#24937E]">Jamaah</span>
                </div>
                <div class="font-semibold text-gray-900 text-xl mb-1">Direktori Jamaah</div>
                <div class="text-gray-500">Lihat daftar jamaah di wilayah Anda.</div>
                <div class="flex justify-end mt-4">
                    <svg class="w-6 h-6 text-[#24937E] group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            <!-- Jadwal Card -->
            <a href="{{ route('user.schedule') }}"
                class="group block rounded-xl bg-white shadow-md hover:shadow-lg transition p-6 border border-gray-100 hover:border-[#24937E]">
                <div class="flex items-center gap-3 mb-4">
                    <img src="/Logo.png" alt="Jadwal" class="h-10 w-10 rounded-full object-cover bg-gray-100">
                    <span class="text-lg font-bold text-[#24937E]">Jadwal</span>
                </div>
                <div class="font-semibold text-gray-900 text-xl mb-1">Jadwal Kegiatan</div>
                <div class="text-gray-500">Lihat jadwal kegiatan dakwah dan komunitas.</div>
                <div class="flex justify-end mt-4">
                    <svg class="w-6 h-6 text-[#24937E] group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>
    </div>
</x-website-layout>

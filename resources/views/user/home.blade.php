<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto p-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Beranda', 'url' => route('user.home')],
    ]" />
    </div>

    <!-- Content -->
    <div class="container max-w-6xl px-6 mx-auto mb-6">
        <div class="relative bg-cover bg-center rounded-lg overflow-hidden"
            style="background-image: url('/website/home.jpg'); height: 500px;">
            <div
                class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center px-4">
                <h1 class="text-white font-bold mb-8 sm:text-4xl lg:text-5xl">Jelajahi Komunitas Muslim</h1>
                <x-web.search-bar />
            </div>
        </div>

        <div class="mt-10 w-full mx-auto">
            <h2 class="text-2xl font-bold mb-2">Temukan apa yang Anda butuhkan</h2>
            <p class="mb-10 text-gray-700">Terhubung dengan masjid, jamaah, dan kegiatan dakwah di daerah Anda.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <a href="{{ route('user.mesjid') }}"
                    class="block rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="/website/mesjid-card.jpg" alt="Masjid" class="w-full h-40 object-cover" />
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Masjid</h3>
                        <p class="text-gray-600 text-sm">Temukan masjid lokal untuk beribadah, belajar, dan
                            berinteraksi.</p>
                    </div>
                </a>
                <a href="{{ route('user.jemaah') }}"
                    class="block rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="/website/jemaah-card.jpg" alt="Jamaah" class="w-full h-40 object-cover" />
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Jemaah</h3>
                        <p class="text-gray-600 text-sm">Temukan jemaah dan kelompok komunitas.</p>
                    </div>
                </a>
                <a href="{{ route('user.schedule') }}"
                    class="block rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="/website/dakwah.jpg" alt="Kegiatan Dakwah" class="w-full h-40 object-cover" />
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Kegiatan Dakwah</h3>
                        <p class="text-gray-600 text-sm">Jelajahi kegiatan dakwah, kelas, dan acara.</p>
                    </div>
                </a>
                <a href="{{ route('user.direktori') }}"
                    class="block rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="/website/direktori.jpg" alt="Direktori" class="w-full h-40 object-cover" />
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Direktori</h3>
                        <p class="text-gray-600 text-sm">Jelajahi semua data dalam satu tempat.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

</x-website-layout>

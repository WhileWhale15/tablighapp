<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto py-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Tentang', 'url' => route('user.about')],
    ]" />
    </div>

    <!-- Content -->
    <div class="max-w-6xl mx-auto">
        <img src="/website/about.jpg" alt="Mosque community" class="rounded-lg w-full object-cover mb-8"
            style="height: 500px;" />

        <h1 class="text-3xl md:text-4xl font-extrabold mb-8 text-gray-900 leading-tight">
            Menyatukan Informasi dan Komunitas Masjid dalam Satu Platform yang Mudah Diakses
        </h1>

        <div class="mb-8">
            <h2 class="font-bold text-lg mb-1">Tentang Website Ini</h2>
            <p class="text-gray-700">
                Website ini dirancang sebagai sistem informasi manajemen berbasis web untuk memudahkan masyarakat
                mengakses data masjid, kegiatan dakwah, wilayah kelurahan, dan jamaah di Kota Binjai. Tujuan utama kami
                adalah menyediakan platform yang informatif, mudah digunakan, dan ramah bagi semua kalangan, termasuk
                orang tua dan lansia.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="font-bold text-lg mb-1">Latar Belakang</h2>
            <p class="text-gray-700">
                Kami menyadari bahwa banyak data penting terkait kegiatan keagamaan dan masjid sering kali tersebar atau
                sulit diakses. Dengan membangun sistem terpusat ini, kami berharap bisa membantu masyarakat dan pengurus
                masjid menjalin komunikasi yang lebih efektif serta menyebarluaskan informasi dengan cara yang efisien
                dan terstruktur.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="font-bold text-lg mb-6">Fitur Utama</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Fitur 1 -->
                <div class="bg-white shadow-md rounded-lg p-6 flex items-start gap-4 hover:shadow-lg transition">
                    <svg class="w-10 h-10 text-indigo-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10l1.9-2.1a2 2 0 0 1 3 .2L10 11l3.2-4a2 2 0 0 1 3 .2L21 14H3z" />
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-lg">Direktori Masjid</h3>
                        <p class="text-gray-600 text-sm">Daftar masjid lengkap dan terverifikasi di Kota Binjai.</p>
                    </div>
                </div>

                <!-- Fitur 2 -->
                <div class="bg-white shadow-md rounded-lg p-6 flex items-start gap-4 hover:shadow-lg transition">
                    <svg class="w-10 h-10 text-green-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17v-4H5v4H3V9h2v4h4V9h2v8H9zM15 17h6m-3-3v6" />
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-lg">Data Kelurahan</h3>
                        <p class="text-gray-600 text-sm">Informasi wilayah kelurahan dan masjid cakupannya.</p>
                    </div>
                </div>

                <!-- Fitur 3 -->
                <div class="bg-white shadow-md rounded-lg p-6 flex items-start gap-4 hover:shadow-lg transition">
                    <svg class="w-10 h-10 text-yellow-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 11h14M5 19h14M7 15h10" />
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-lg">Kegiatan Dakwah</h3>
                        <p class="text-gray-600 text-sm">Lihat jadwal dan laporan kegiatan dakwah terbaru.</p>
                    </div>
                </div>

                <!-- Fitur 4 -->
                <div class="bg-white shadow-md rounded-lg p-6 flex items-start gap-4 hover:shadow-lg transition">
                    <svg class="w-10 h-10 text-blue-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 0 0-5-4m-4 6h-6a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v9a4 4 0 0 1-4 4z" />
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-lg">Data Jamaah</h3>
                        <p class="text-gray-600 text-sm">Informasi jamaah yang telah didaftarkan dan diverifikasi.</p>
                    </div>
                </div>

                <!-- Fitur 5 -->
                <div class="bg-white shadow-md rounded-lg p-6 flex items-start gap-4 hover:shadow-lg transition">
                    <svg class="w-10 h-10 text-purple-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10 6H6a2 2 0 0 0-2 2v4h6V6zm0 6H4v4a2 2 0 0 0 2 2h4v-6zm4 0h6v-4a2 2 0 0 0-2-2h-4v6zm0 0v6h4a2 2 0 0 0 2-2v-4h-6z" />
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-lg">Pencarian Cepat</h3>
                        <p class="text-gray-600 text-sm">Temukan informasi dengan cepat lewat fitur pencarian.</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="mb-8">
            <h2 class="font-bold text-lg mb-4">Dibangun oleh</h2>
            <div class="flex items-center gap-4 bg-gray-50 rounded-lg p-4">
                <img src="/Logo.png" alt="Logo Proyek" class="w-14 h-14 rounded-full border border-gray-200" />
                <div class="flex-1">
                    <div class="font-semibold text-lg">Sistem Informasi Jamaah Tabligh Binjai</div>
                    <div class="text-gray-500 text-sm">Proyek akhir yang didedikasikan untuk mendukung komunitas dakwah
                        lokal</div>
                </div>
                <div class="flex gap-2">
                    <a href="#"
                        class="px-4 py-2 rounded-md bg-gray-200 text-gray-900 font-semibold hover:bg-gray-300 transition">
                        Lihat GitHub
                    </a>
                    <a href="#"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                        Kontak Developer
                    </a>
                </div>
            </div>
        </div> -->
    </div>

    <!-- Footer -->


</x-website-layout>

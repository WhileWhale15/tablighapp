<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto py-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Jadwal Kegiatan Dakwah', 'url' => route('user.schedule')],
        ['label' => $kegiatan->judul, 'url' => route('user.kegiatan.detail', $kegiatan)],
    ]" />
    </div>

    <!-- Content -->
    <div class="container max-w-6xl mx-auto mb-6">
        <div class="bg-white rounded-lg shadow p-6 flex flex-col md:flex-row gap-8">
            <!-- Left: Event Image -->
            <div class="md:w-1/3 w-full flex-shrink-0 flex items-center justify-center mb-6 md:mb-0">
                <img src="{{ $kegiatan->mesjid->image_url ?? '/images/default-mosque.jpg' }}" alt="Masjid"
                    class="w-full h-full object-cover rounded-lg shadow" />
            </div>
            <!-- Right: Event Details -->
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold mb-2">{{ $kegiatan->judul }}</h1>
                <div class="flex items-center gap-2 mb-4">
                    <span
                        class="inline-block px-3 py-1 rounded-lg bg-purple-600 text-white text-xs font-semibold">Kegiatan
                        Dakwah</span>
                    <span class="text-gray-500 text-sm">{{ $kegiatan->tanggal->format('l, d M Y') }}</span>
                    <span class="text-gray-500 text-sm">{{ $kegiatan->tanggal->format('g:i a') }}</span>
                </div>
                <div class="mb-4 text-gray-700">
                    <span class="font-semibold">Deskripsi:</span><br>
                    {{ $kegiatan->deskripsi ?? '-' }}
                </div>
                <div class="mb-2 text-gray-700">
                    <span class="font-semibold">Masjid:</span> {{ $kegiatan->mesjid->nama_mesjid ?? '-' }}
                </div>
                <div class="mb-2 text-gray-700">
                    <span class="font-semibold">Alamat:</span> {{ $kegiatan->mesjid->alamat ?? '-' }}
                </div>
                <div class="mb-2 text-gray-700">
                    <span class="font-semibold">Kelurahan:</span>
                    {{ $kegiatan->mesjid->kelurahan->nama_kelurahan ?? '-' }}
                </div>
                <div class="mb-2 text-gray-700">
                    <span class="font-semibold">Kecamatan:</span>
                    {{ $kegiatan->mesjid->kelurahan->kecamatan->nama_kecamatan ?? '-' }}
                </div>
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-[#24937E] mb-2">Catatan Kegiatan Dakwah</h3>
                    <div class="text-gray-700 bg-gray-50 rounded p-3 min-h-[48px]">
                        {{ $kegiatan->catatan ?? 'Belum ada catatan untuk kegiatan ini.' }}
                    </div>
                </div>
                @if($kegiatan->mesjid && $kegiatan->mesjid->alamat)
                    <div class="mt-4 flex gap-4">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($kegiatan->mesjid->alamat) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-[#208471] text-white rounded-lg hover:bg-[#124A3F] font-semibold">Lihat
                            di Google Maps</a>
                    </div>
                @endif
                <a href="{{ url()->previous() }}" class="inline-block mt-8 text-[#0E5D4E] hover:underline">
                    &larr; Kembali ke jadwal</a>
            </div>
        </div>
    </div>

</x-website-layout>

<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto p-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Direktori', 'url' => route('user.direktori')],
        ['label' => 'Direktori Masjid', 'url' => route('user.mesjid')],
        ['label' => $masjid->nama_mesjid],
    ]" />
    </div>

    <!-- Content -->
    <div class="container max-w-6xl px-6 mx-auto mb-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 w-full h-64 md:h-auto bg-gray-100 flex items-center justify-center">
                    <img src="{{ $masjid->image_url ?? '/images/default-mosque.jpg' }}" alt="Foto Masjid"
                        class="object-cover w-full h-full">
                </div>
                <div class="md:w-1/2 w-full p-6 flex flex-col gap-2">
                    <h1 class="text-2xl font-bold text-[#24937E] mb-2">{{ $masjid->nama_mesjid }}</h1>
                    <div class="text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $masjid->alamat }}</span>
                    </div>
                    <div class="text-gray-600 text-sm mb-2">Kelurahan: {{ $masjid->kelurahan->nama_kelurahan ?? '-' }}
                    </div>
                    <div class="text-gray-600 text-sm mb-2">Kecamatan:
                        {{ $masjid->kelurahan->kecamatan->nama_kecamatan ?? '-' }}
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($masjid->alamat) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-[#24937E] text-white rounded-lg font-medium hover:bg-[#0E5D4E] transition">Lihat
                            di Google Maps</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Jadwal & Kegiatan di Masjid</h2>
            @if($masjid->kegiatan && $masjid->kegiatan->count())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($masjid->kegiatan as $kegiatan)
                        <div class="bg-gray-50 rounded-lg p-4 shadow flex flex-col gap-1">
                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                                <span class="font-semibold">{{ $kegiatan->tanggal->translatedFormat('d F Y') }}</span>
                                <span>|</span>
                                <span>{{ $kegiatan->tanggal->format('H:i') }} -
                                    {{ $kegiatan->tanggal->addHours(2)->format('H:i') }}</span>
                            </div>
                            <div class="font-bold text-lg text-[#24937E]">{{ $kegiatan->judul }}</div>
                            <div class="text-gray-600 text-sm line-clamp-2">{{ $kegiatan->deskripsi }}</div>
                            <a href="{{ route('user.kegiatan.detail', $kegiatan->id) }}"
                                class="text-[#0E5D4E] hover:underline text-xs mt-2">Detail Kegiatan</a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-gray-500">Belum ada jadwal atau kegiatan terdaftar.</div>
            @endif
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Jamaah Masjid</h2>
            @if($masjid->jamaah && $masjid->jamaah->count())
                <div class="flex flex-wrap gap-2">
                    @foreach($masjid->jamaah as $jamaah)
                        <span
                            class="inline-block bg-[#24937E] text-white px-3 py-1 rounded-full text-sm">{{ $jamaah->nama }}</span>
                    @endforeach
                </div>
            @else
                <div class="text-gray-500">Belum ada jamaah terdaftar.</div>
            @endif
        </div>
    </div>

</x-website-layout>

<x-website-layout>

    <div class="max-w-4xl mx-auto py-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Beranda', 'url' => route('user.home')],
        ['label' => 'Jadwal', 'url' => route('user.schedule')],
        ['label' => $jadwal->judul],
    ]" />

        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-[#24937E] mb-2">{{ $jadwal->judul }}</h1>
                <div class="text-gray-700 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $jadwal->tanggal->translatedFormat('d F Y') }} | {{ $jadwal->tanggal->format('H:i') }} -
                        {{ $jadwal->tanggal->addHours(2)->format('H:i') }}</span>
                </div>
                <div class="text-gray-600 text-sm mb-2">Masjid: <a
                        href="{{ route('user.mesjid.show', $jadwal->mesjid->id) }}"
                        class="text-[#24937E] hover:underline">{{ $jadwal->mesjid->nama_mesjid ?? '-' }}</a></div>
                <div class="text-gray-600 text-sm mb-2">Alamat: {{ $jadwal->mesjid->alamat ?? '-' }}</div>
                <div class="mt-4 text-gray-800">{{ $jadwal->deskripsi }}</div>
            </div>
        </div>
    </div>

</x-website-layout>

<x-website-layout>
    <div class="max-w-6xl mx-auto p-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Beranda', 'url' => route('user.home')],
        ['label' => 'Jemaah', 'url' => route('user.jemaah')],
        ['label' => $jamaah->nama],
    ]" />
    </div>

    <div class="container max-w-6xl px-6 mx-auto mb-6">
        <div
            class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 border border-[#24937E] flex flex-col md:flex-row">
            <div class="md:w-1/3 w-full h-48 md:h-auto bg-gray-100 flex items-center justify-center">
                <img src="{{ $jamaah->user && $jamaah->user->profile_picture ? asset('storage/' . $jamaah->user->foto_profil) : ($jamaah->foto_url ?? '/images/default-mosque.jpg') }}"
                    alt="Foto Jamaah" class="object-cover w-full h-full border border-[#24937E] shadow">
            </div>
            <div class="md:w-2/3 w-full p-6 flex flex-col gap-2 justify-center">
                <h1 class=" text-2xl font-bold text-gray-800 mb-2">{{ $jamaah->nama }}</h1>
                <div class="flex items-center text-gray-700 mb-2">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>{{ $jamaah->alamat ?? '-' }}</span>
                </div>
                <div class="text-gray-600 text-sm mb-1">
                    <span class="font-semibold">No. KTP:</span>
                    {{ $jamaah->no_ktp ?? '-' }}
                </div>
                <div class="text-gray-600 text-sm mb-1">
                    <span class="font-semibold">No. Telepon:</span>
                    {{ $jamaah->no_telepon ?? '-' }}
                </div>
                <div class="text-gray-600 text-sm mb-1">
                    <span class="font-semibold">Jenis Kelamin:</span>
                    {{ $jamaah->jenis_kelamin ?? '-' }}
                </div>
                <div class="text-gray-600 text-sm mb-1">
                    <span class="font-semibold">Masjid:</span>
                    {{ $jamaah->mesjid->nama_mesjid ?? '-' }}
                </div>
                <div class="text-gray-600 text-sm mb-1">
                    <span class="font-semibold">Kelurahan:</span>
                    {{ $jamaah->mesjid->kelurahan->nama_kelurahan ?? '-' }}
                </div>
                <div class="text-gray-600 text-sm mb-1">
                    <span class="font-semibold">Kecamatan:</span>
                    {{ $jamaah->mesjid->kelurahan->kecamatan->nama_kecamatan ?? '-' }}
                </div>
                <a href="{{ url()->previous() }}" class="mt-4 inline-block text-[#24937E] hover:underline">&larr;
                    Kembali ke daftar jemaah
                </a>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Pengalaman Khuruj</h2>
            @if($jamaah->pengalamanKhuruj && $jamaah->pengalamanKhuruj->count())
                <ul class="list-disc pl-6 text-gray-700"> @foreach($jamaah->pengalamanKhuruj as $pengalaman)
                    <li>{{ $pengalaman->tahun }} - {{ $pengalaman->keterangan }}</li>
                @endforeach
                </ul>
            @else
                <div class="text-gray-500">Belum ada pengalaman khuruj terdaftar.
                </div>
            @endif
        </div>
    </div>
</x-website-layout>

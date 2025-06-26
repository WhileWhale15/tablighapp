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
        <div class="bg-white rounded-lg shadow p-8 mt-6 border border-[#24937E]">
            <h1 class="text-3xl font-bold mb-4 text-[#24937E]">{{ $masjid->nama_mesjid }}</h1>
            <div class="mb-2 text-gray-700">
                <span class="font-semibold">Alamat:</span>
                {{ $masjid->alamat }}
            </div>
            <div class="mb-2 text-gray-700">
                <span class="font-semibold">Kelurahan:</span>
                {{ $masjid->kelurahan->nama_kelurahan ?? '-' }}
            </div>
            <div class="mb-2 text-gray-700">
                <span class="font-semibold">Kecamatan:</span>
                {{ $masjid->kelurahan->kecamatan->nama_kecamatan ?? '-' }}
            </div>
            <div class="mb-2 text-gray-700">
                <span class="font-semibold">Jumlah Jemaah:</span>
                {{ $masjid->jemaah->count() ?? '-' }}
            </div>
            <a href="{{ route('user.mesjid') }}" class="inline-block mt-8 text-[#24937E] hover:underline">&larr; Kembali
                ke daftar masjid
            </a>
        </div>

        <!-- Map Section -->
        @if($masjid->alamat)
            <div class="w-full my-8 rounded-lg overflow-hidden border border-[#24937E]">
                <iframe width="100%" height="400" frameborder="0" style="border:0"
                    src="https://www.google.com/maps?q={{ urlencode($masjid->alamat) }}&output=embed" allowfullscreen>
                </iframe>
            </div>
        @else
            <div
                class="w-full my-8 rounded-lg overflow-hidden border border-[#24937E] bg-gray-50 flex items-center justify-center min-h-[120px]">
                <span class="text-gray-500 text-lg">Alamat masjid tidak tersedia.</span>
            </div>
        @endif

        <!-- Jemaah List Section -->
        <div class="bg-white rounded-lg shadow p-8 mt-6 border border-[#24937E]">
            <h2 class="text-2xl font-bold mb-4 text-[#24937E]">Daftar Jemaah Terafiliasi</h2>
            @if($masjid->jemaah && $masjid->jemaah->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#24937E] border border-[#24937E] rounded-lg text-sm">
                        <thead class="bg-[#24937E] text-white">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Jenis Kelamin
                                </th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">No. KTP</th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">No. Telepon
                                </th>
                                <th class="w-[85px] px-4 py-2 text-left text-xs font-medium uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#24937E]">
                            @foreach($masjid->jemaah as $jemaah)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $jemaah->nama }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $jemaah->jenis_kelamin ?? '-' }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-gray-500">{{ $jemaah->no_ktp }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-gray-500">{{ $jemaah->no_telepon ?? '-' }}</td>
                                    <td class="w-[85px] px-4 py-2 whitespace-nowrap">
                                        <a href="{{ route('user.jamaah.detail', $jemaah->id) }}"
                                            class="text-[#24937E] hover:underline font-medium">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-gray-500">Belum ada jemaah terdata untuk masjid ini.</div>
            @endif
        </div>
    </div>

    <!-- Histori Kegiatan Dakwah -->
    <div class="container max-w-6xl px-6 mx-auto mb-12">
        <div class="bg-white rounded-lg shadow p-8 mt-6 border border-[#24937E]">
            <h2 class="text-2xl font-bold mb-4 text-[#24937E]">Histori Kegiatan Dakwah di Masjid Ini</h2>
            @if($masjid->kegiatanDakwah && $masjid->kegiatanDakwah->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#24937E] border border-[#24937E] rounded-lg text-sm">
                        <thead class="bg-[#24937E] text-white">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Nama Kegiatan
                                </th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Penceramah</th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider">Keterangan</th>
                                <th class="w-[85px] px-4 py-2 text-left text-xs font-medium uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#24937E]">
                            @foreach($masjid->kegiatanDakwah as $kegiatan)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $kegiatan->nama_kegiatan }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        {{ $kegiatan->tanggal_kegiatan ? \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $kegiatan->penceramah ?? '-' }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $kegiatan->keterangan ?? '-' }}</td>
                                    <td class="w-[85px] px-4 py-2 whitespace-nowrap">
                                        <a href="{{ route('user.kegiatan.detail', $kegiatan->id) }}"
                                            class="text-[#24937E] hover:underline font-medium">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-gray-500">Belum ada histori kegiatan dakwah untuk masjid ini.</div>
            @endif
        </div>
    </div>

</x-website-layout>

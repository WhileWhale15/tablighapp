<x-website-layout>
    <div class="container max-w-3xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Detail Kecamatan</h1>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-semibold mb-2">{{ $kecamatan->nama_kecamatan }}</h2>
            <div class="text-gray-600 mb-2">ID: {{ $kecamatan->id }}</div>
            <div class="text-gray-700">Deskripsi: {{ $kecamatan->deskripsi ?? '-' }}</div>
        </div>
        <a href="{{ url()->previous() }}" class="mt-6 inline-block text-blue-600 hover:underline">&larr; Kembali</a>

        @if($kecamatan->kelurahans->count())
            <div class="mt-10">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Kelurahan di Kecamatan ini</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($kecamatan->kelurahans as $kelurahan)
                        <a href="{{ route('user.kelurahan.show', $kelurahan->id) }}"
                            class="block bg-white border border-[#24937E] rounded-lg shadow hover:shadow-lg transition p-5 group">
                            <div class="text-lg font-bold text-[#24937E] group-hover:underline mb-1">
                                {{ $kelurahan->nama_kelurahan }}</div>
                            <div class="text-gray-600 text-sm">ID: {{ $kelurahan->id }}</div>
                            <div class="text-gray-500 text-xs mt-1">Klik untuk detail kelurahan</div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="mt-10 text-gray-500">Belum ada kelurahan di kecamatan ini.</div>
        @endif
    </div>
</x-website-layout>

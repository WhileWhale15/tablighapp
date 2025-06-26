<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto p-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Direktori', 'url' => route('user.direktori')],
        ['label' => 'Direktori Kelurahan', 'url' => route('user.kelurahan')],
        ['label' => $kelurahan->nama_kelurahan],
    ]" />
    </div>

    <!-- Content -->
    <div class="container max-w-6xl px-6 mx-auto mb-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-[#24937E] mb-2">{{ $kelurahan->nama_kelurahan }}</h1>
                <div class="text-gray-700 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Kecamatan: {{ $kelurahan->kecamatan->nama_kecamatan ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Daftar Masjid di Kelurahan Ini</h2>
            @if($kelurahan->mesjids && $kelurahan->mesjids->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($kelurahan->mesjids as $masjid)
                        <a href="{{ route('user.masjid.detail', $masjid->id) }}"
                            class="group block bg-white border border-[#24937E]/30 rounded-xl shadow-sm hover:shadow-lg transition p-5 h-full">
                            <div class="flex items-center gap-4 mb-3">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-[#24937E]/10 rounded-full flex items-center justify-center">
                                    <svg class="w-7 h-7 text-[#24937E]" version="1.0" xmlns="http://www.w3.org/2000/svg"
 viewBox="0 0 512.000000 512.000000"
 preserveAspectRatio="xMidYMid meet">

<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
fill="currentColor" stroke="none">
<path d="M2467 4629 c-117 -27 -240 -125 -290 -230 -110 -234 7 -506 254 -589
52 -18 81 -21 155 -18 81 3 100 8 167 41 159 78 255 244 202 346 -59 114 -216
117 -281 5 -34 -57 -59 -74 -110 -74 -52 0 -90 28 -103 77 -19 68 32 133 105
133 42 0 106 36 132 73 16 24 22 48 22 87 0 122 -106 184 -253 149z"/>
<path d="M2495 3664 c-49 -25 -62 -42 -104 -129 -75 -154 -196 -241 -590 -422
-124 -57 -263 -124 -310 -149 -294 -156 -463 -331 -541 -559 -34 -99 -35 -102
-35 -275 0 -140 4 -188 18 -240 48 -170 119 -303 220 -418 26 -29 47 -54 47
-57 0 -2 -25 -15 -55 -29 -67 -30 -154 -115 -188 -182 -43 -85 -49 -126 -48
-327 2 -221 12 -260 88 -327 86 -75 -28 -70 1563 -70 1591 0 1477 -5 1563 70
26 23 53 60 66 91 21 48 22 63 19 262 l-3 212 -32 68 c-39 83 -118 164 -197
204 l-58 29 52 60 c112 127 190 289 226 465 12 62 15 116 12 223 -4 125 -8
151 -37 236 -41 122 -106 226 -201 321 -136 137 -281 223 -671 402 -380 174
-497 259 -574 419 -19 39 -43 80 -53 91 -39 45 -123 60 -177 31z m124 -505
c142 -125 371 -261 586 -348 105 -43 333 -159 408 -208 89 -59 183 -153 219
-219 85 -156 77 -354 -22 -559 -75 -155 -191 -272 -348 -350 l-71 -35 -831 0
-831 0 -71 35 c-157 78 -273 195 -348 350 -126 261 -104 497 60 665 95 97 298
217 540 319 264 112 448 220 590 350 30 28 56 50 58 51 2 0 29 -23 61 -51z
m1211 -2057 c51 -25 60 -51 60 -184 l0 -118 -1330 0 -1330 0 0 118 c0 133 9
159 60 184 33 17 114 18 1270 18 1156 0 1237 -1 1270 -18z"/>
</g>
</svg>
                                </div>
                                <div>
                                    <div class="font-bold text-lg text-[#24937E] group-hover:underline">
                                        {{ $masjid->nama_mesjid }}</div>
                                    <div class="text-gray-500 text-xs">{{ $masjid->alamat }}</div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <span class="text-[#24937E] text-sm font-medium group-hover:underline flex items-center gap-1">
                                    Detail
                                    <svg class="w-4 h-4 ml-1 text-[#24937E] group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-gray-500">Belum ada masjid terdaftar di kelurahan ini.</div>
            @endif
        </div>
    </div>

</x-website-layout>

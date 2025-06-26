<x-website-layout>

    <!-- Content -->
    <div class="container max-w-6xl mx-auto px-4 py-12 mb-6">
        <h1 class="py-3 pb-8 text-5xl font-semibold text-gray-800">Hasil pencarian untuk:
            <span class="text-[#24937E]">{{ $query }}</span>
        </h1>

        <!-- Filter Chips -->
        <div class="flex flex-wrap gap-2 mb-6">
            @php
                $filters = [
                    'kecamatan' => 'Kecamatan',
                    'kelurahan' => 'Kelurahan',
                    'mesjid' => 'Mesjid',
                    'jemaah' => 'Jemaah',
                    'kegiatan' => 'Kegiatan Dakwah',
                ];
                $activeFilters = collect(request()->query('filter', []));
            @endphp
            @foreach($filters as $key => $label)
                @if($activeFilters->contains($key))
                    <div id="chip-{{ $key }}"
                        class="relative rounded-md flex bg-slate-800 py-0.5 pl-2.5 pr-8 border border-transparent text-sm text-white transition-all shadow-sm">
                        {{ $label }}
                        <form method="GET" action="" class="inline">
                            @foreach(request()->except('filter') as $param => $val)
                                <input type="hidden" name="{{ $param }}" value="{{ $val }}">
                            @endforeach
                            @foreach($activeFilters->reject(fn($f) => $f === $key) as $f)
                                <input type="hidden" name="filter[]" value="{{ $f }}">
                            @endforeach
                            <button
                                class="flex items-center justify-center transition-all p-1 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-0.5 right-0.5"
                                type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                    <path
                                        d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <form method="GET" action="" class="inline">
                        @foreach(request()->except('filter') as $param => $val)
                            <input type="hidden" name="{{ $param }}" value="{{ $val }}">
                        @endforeach
                        @foreach($activeFilters as $f)
                            <input type="hidden" name="filter[]" value="{{ $f }}">
                        @endforeach
                        <input type="hidden" name="filter[]" value="{{ $key }}">
                        <button type="submit"
                            class="rounded-md flex bg-slate-200 py-0.5 pl-2.5 pr-2 border border-transparent text-sm text-slate-800 transition-all shadow-sm hover:bg-slate-300">
                            {{ $label }}
                        </button>
                    </form>
                @endif
            @endforeach
        </div>

        <script>
            function closeAlert() {
                const chipElement = document.getElementById('chip');
                chipElement.style.display = 'none'; // Hide the chip
            }
        </script>

        @if($results->count())
            <ul class="flex flex-col gap-4 divide-y divide-gray-200 mb-4">
                @foreach ($results as $item)
                    @php
                        // Determine type and route
                        if (isset($item->nama_kecamatan)) {
                            $type = 'kecamatan';
                            $route = route('user.kecamatan.show', $item->id);
                            $label = 'Kecamatan';
                            $labelClass = 'bg-blue-600';
                            $title = $item->nama_kecamatan;
                        } elseif (isset($item->nama_kelurahan)) {
                            $type = 'kelurahan';
                            $route = route('user.kelurahan.detail', $item->id);
                            $label = 'Kelurahan';
                            $labelClass = 'bg-green-600';
                            $title = $item->nama_kelurahan;
                        } elseif (isset($item->nama_mesjid)) {
                            if (isset($item->alamat)) {
                                $type = 'mesjid';
                                $route = route('user.masjid.detail', $item->id);
                                $label = 'Mesjid';
                                $labelClass = 'bg-yellow-500';
                                $title = $item->nama_mesjid;
                            } else {
                                $type = 'jemaah';
                                $route = route('user.jamaah.detail', $item->id);
                                $label = 'Jemaah';
                                $labelClass = 'bg-pink-600';
                                $title = $item->nama_mesjid;
                            }
                        } elseif (isset($item->judul)) {
                            $type = 'kegiatan';
                            $route = route('user.kegiatan-dakwah.show', $item->id);
                            $label = 'Kegiatan';
                            $labelClass = 'bg-purple-600';
                            $title = $item->judul;
                        } else {
                            $type = 'jemaah';
                            $route = route('user.jamaah.detail', $item->id);
                            $label = 'Jemaah';
                            $labelClass = 'bg-pink-600';
                            $title = $item->nama;
                        }
                    @endphp
                    <li class="flex items-center gap-4 pt-4">
                        <a href="{{ $route }}"
                            class="flex items-center gap-4 w-full group hover:bg-slate-100 rounded-lg transition p-2 -m-2">
                            <img src="{{ $item->image_url ?? '/images/default-mosque.jpg' }}" alt=""
                                class="w-14 h-14 rounded-lg object-cover flex-shrink-0" />
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-base text-gray-900 group-hover:text-[#24937E]">{{ $title }}</div>
                                <div class="mt-1 flex items-center gap-2">
                                    <span
                                        class="px-2 py-0.5 rounded text-xs font-medium {{ $labelClass }} text-white">{{ $label }}</span>
                                    <span class="text-gray-500 text-sm truncate">
                                        @if(isset($item->alamat))
                                            {{ $item->alamat }}
                                        @elseif(isset($item->deskripsi))
                                            {{ $item->deskripsi }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="mt-12 mb-6">{{ $results->links() }}</div>
        @else
            <p class="text-gray-500">Tidak ada hasil ditemukan.</p>
        @endif
    </div>

    <!-- Footer -->


</x-website-layout>

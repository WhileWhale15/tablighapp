<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto py-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Direktori', 'url' => route('user.direktori')],
        ['label' => 'Direktori Jamaah', 'url' => route('user.jemaah')],
    ]" />
    </div>

    <!-- Content -->
    <div class="container max-w-6xl mx-auto mb-6">
        <!-- Title -->
        <div class="">
            <h1 class="py-3 text-5xl font-semibold text-gray-800">Direktori Jemaah</h1>
        </div>

        <!-- Filters -->
        <form method="GET" class="flex gap-4 mb-4" id="filterForm" onsubmit="return false;">
            <select name="mesjid_id" id="mesjidFilter"
                class="rounded-lg border border-gray-300 px-3 py-2 min-w-[250px]">
                <option value="">Semua mesjid</option>
                @foreach($mesjids as $mesjid)
                    <option value="{{ $mesjid->id }}" {{ request('mesjid_id') == $mesjid->id ? 'selected' : '' }}>
                        {{ $mesjid->nama_mesjid }}
                    </option>
                @endforeach
            </select>
            <select name="jenis_kelamin" id="jkFilter"
                class="rounded-lg border border-gray-300 px-3 py-2 min-w-[250px]">
                <option value="">Semua jenis kelamin</option>
                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                </option>
                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                </option>
            </select>
        </form>

        <!-- Search -->
        <div class="w-full mb-6">
            <input id="searchInput" type="text" placeholder="Cari jemaah..."
                class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-[#24937E] focus:border-[#24937E] transition" />
        </div>

        <!-- Table -->
        <div class="rounded-lg overflow-x-auto">
            <table id="jamaahTable" class="min-w-full divide-y divide-[#24937E] border border-[#24937E] rounded-lg">
                <thead class="bg-[#24937E] text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No. KTP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No. Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Mesjid</th>
                        <th class="w-[85px] px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#24937E]">
                    @foreach ($jamaah as $item)
                        <tr class="hover:bg-gray-50 transition cursor-pointer group"
                            onclick="window.location='{{ route('user.jamaah.detail', $item->id) }}'" tabindex="0">
                            <td class="px-6 py-4 whitespace-nowrap" data-jk="{{ $item->jenis_kelamin }}">{{ $item->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $item->no_ktp }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $item->no_telepon ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#24937E] font-semibold">
                                {{ $item->mesjid_id ? $item->mesjid->nama_mesjid : 'Tidak ada masjid' }}
                            </td>
                            <td class="w-[85px] px-6 py-4 whitespace-nowrap text-right">
                                <span
                                    class="inline-flex items-center gap-1 text-[#24937E] font-medium group-hover:underline">
                                    Detail
                                    <svg class="w-4 h-4 ml-1 text-[#24937E] group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($jamaah, 'links'))
            <div class="mt-6">
                {{ $jamaah->links() }}
            </div>
        @endif
    </div>

    <script>
        // Instant filtering for table rows by name, mesjid, and jenis kelamin
        const searchInput = document.getElementById('searchInput');
        const mesjidFilter = document.getElementById('mesjidFilter');
        const jkFilter = document.getElementById('jkFilter');
        const rows = document.querySelectorAll('#jamaahTable tbody tr');

        function filterTable() {
            const search = searchInput.value.toLowerCase();
            const mesjid = mesjidFilter.value;
            const jk = jkFilter.value;
            rows.forEach(row => {
                const nama = row.querySelector('td').textContent.toLowerCase();
                const mesjidCell = row.querySelectorAll('td')[3]?.textContent.trim();
                const jkCell = row.querySelectorAll('td')[0]?.getAttribute('data-jk') || '';
                let show = true;
                if (search && !nama.includes(search)) show = false;
                if (mesjid && mesjidCell !== mesjidFilter.options[mesjidFilter.selectedIndex].text) show = false;
                if (jk && jkCell !== jk) show = false;
                row.style.display = show ? '' : 'none';
            });
        }
        searchInput.addEventListener('input', filterTable);
        mesjidFilter.addEventListener('change', filterTable);
        jkFilter.addEventListener('change', filterTable);
    </script>
</x-website-layout>

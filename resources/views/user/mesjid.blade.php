<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto py-6 sm:px-4">
        <x-web.breadcrumb :items="[
        ['label' => 'Direktori', 'url' => route('user.direktori')],
        ['label' => 'Direktori Masjid', 'url' => route('user.mesjid')],
    ]" />
    </div>

    <!-- Content -->
    <div class="container max-w-6xl px-6 mx-auto mb-6">
        <h1 class="py-3 text-5xl font-semibold text-gray-800">Direktori Masjid</h1>
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full divide-y divide-[#24937E] border border-[#24937E] rounded-lg text-sm">
                <thead class="bg-[#24937E] text-white">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                            Nama Masjid</th>
                        <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                            Alamat</th>
                        <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                            Kelurahan</th>
                        <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#24937E]">
                    @foreach ($masjid as $item)
                        <tr class="hover:bg-gray-50 transition cursor-pointer group"
                            onclick="window.location='{{ route('user.masjid.detail', $item->id) }}'" tabindex="0">
                            <td class="px-3 py-4 whitespace-nowrap font-semibold text-[#24937E] max-w-[180px] truncate">
                                {{ $item->nama_mesjid }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-gray-500 max-w-[220px] truncate">
                                {{ \Illuminate\Support\Str::limit($item->alamat, 50) }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap max-w-[120px] truncate">
                                {{ $item->kelurahan->nama_kelurahan ?? '-' }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-right">
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
        @if(method_exists($masjid, 'links'))
            <div class="mt-6">
                {{ $masjid->links() }}
            </div>
        @endif
    </div>

</x-website-layout>

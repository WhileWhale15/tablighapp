<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto p-6">
        <x-web.breadcrumb :items="[
        ['label' => 'Direktori', 'url' => route('user.direktori')],
        ['label' => 'Direktori Kelurahan', 'url' => route('user.kelurahan')],
    ]" />
    </div>

    <!-- Content -->
    <div class="container max-w-6xl px-6 mx-auto mb-6">
        <h1 class="py-3 text-5xl font-semibold text-gray-800">Direktori Kelurahan</h1>
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full divide-y divide-[#24937E] border border-[#24937E] rounded-lg">
                <thead class="bg-[#24937E] text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Kelurahan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kecamatan</th>
                        <th class="w-[85px] px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#24937E]">
                    @foreach ($kelurahan as $item)
                        <tr class="hover:bg-gray-50 transition cursor-pointer group"
                            onclick="window.location='{{ route('user.kelurahan.detail', $item->id) }}'" tabindex="0">
                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-[#24937E]">{{ $item->nama_kelurahan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                {{ $item->kecamatan->nama_kecamatan ?? '-' }}
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
        <div class="mt-6">
            {{ $kelurahan->links() }}
        </div>
    </div>

    <!-- Footer -->


</x-website-layout>

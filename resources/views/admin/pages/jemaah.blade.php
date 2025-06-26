<x-admin-layout>

    <!-- Title and Breadcrumb -->
    <div class="bg-gray-100  py-4 space-y-2">
        <h1 class="py-3 text-5xl font-semibold text-gray-800">Detail Mesjid</h1>
        <x-breadcrumb :breadcrumbs="[
        ['name' => 'Kelola Data', 'url' => route('data.index')],
        ['name' => 'Daftar Kelurahan', 'url' => $mesjid->kelurahan ? route('kelurahan.index', ['kecamatan_id' => $mesjid->kelurahan->kecamatan_id]) : '#'],
        ['name' => 'Daftar Mesjid', 'url' => $mesjid->kelurahan ? route('mesjid.index', ['kelurahan_id' => $mesjid->kelurahan_id]) : '#'],
        ['name' => 'Detail Mesjid', 'url' => route('jemaah.index', ['mesjid_id' => $mesjid->id])],
    ]" />
    </div>

    <!-- Content -->
    <div class="pt-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex justify-between items-center px-4 py-5 sm:px-6">
                <h3 class="text-2xl leading-6 font-semibold text-gray-900">
                    {{ $mesjid->nama_mesjid }}
                </h3>
                <div class="flex items-center gap-x-2">
                    @if ($mesjid->alamat)
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($mesjid->alamat) }}"
                            target="_blank"
                            class="p-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white bg-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-map-pin">
                                <path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Lihat di Maps
                        </a>
                    @endif
                    <button onclick="openModalById('edit-alamat-modal')"
                        class="p-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg width="16" height="16" viewBox="0 0 14 14" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.0417 13.0417H8.45837M0.958374 13.0417L4.50004 12.2083L12.2441 4.46426C12.5695 4.13881 12.5695 3.61118 12.2441 3.28574L10.7143 1.75592C10.3889 1.43048 9.86121 1.43048 9.53579 1.75592L1.79171 9.5L0.958374 13.0417Z" />
                        </svg>
                        Edit
                    </button>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Alamat Lengkap</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $mesjid->alamat ?? 'Alamat belum ditambahkan' }}
                            @if ($mesjid->koordinat)
                                <a href="https://www.google.com/maps?q={{ $mesjid->koordinat }}" target="_blank"
                                    class="text-blue-500 underline">
                                    Lihat di Google Maps
                                </a>
                            @endif
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Jumlah Jemaah</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $mesjid->jemaah_count }} Jemaah
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Catatan Terakhir</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @php
                                $lastLog = $mesjid->kegiatanDakwah->sortByDesc('tanggal')->first();
                            @endphp
                            @if($lastLog && $lastLog->catatan)
                                {{ $lastLog->catatan }}
                                <span
                                    class="block py-1.5 px-3 rounded-full bg-red-500 text-white">({{ $lastLog->tanggal->format('d M Y') }})</span>
                            @else
                                <span class="py-1.5 px-3 rounded-full bg-red-500 text-white">Belum ada catatan</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white shadow border border-gray-200 rounded-lg">

                        <!-- Tabs Navigation -->
                        <div class="px-4">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex space-x-4" aria-label="Tabs">
                                    <button onclick="showTab('log-tab')" id="log-tab-button"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm text-gray-900 border-blue-500">
                                        Log
                                    </button>
                                    <button onclick="showTab('jemaah-tab')" id="jemaah-tab-button"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                        Daftar Jemaah
                                    </button>
                                </nav>
                            </div>
                        </div>

                        <!-- Search Bar and Tambah Data Button (Visible Only in Daftar Jemaah Tab) -->
                        <div id="jemaah-controls" class="py-6 px-4 hidden">
                            <div class="flex justify-between items-center">
                                <x-admin.search-input id="searchInput" placeholder="Cari jemaah..."
                                    onkeyup="searchTable()" />

                                <button onclick="openModalById('tambah-jemaah-modal')"
                                    class="p-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-plus">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Tambah Data
                                </button>
                            </div>
                        </div>

                        <!-- Tabs Content -->
                        <div id="log-tab" class="tab-content">
                            <div class="py-6">
                                <div class="sm:px-3 lg:px-4">
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">Log Kegiatan
                                                Dakwah</h3>
                                            <p class="mt-1 text-sm text-gray-500">Berikut adalah log kegiatan dakwah
                                                yang pernah dilakukan di masjid ini.</p>
                                        </div>
                                        <button onclick="openModalById('tambah-log-modal')"
                                            class="p-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-plus">
                                                <path d="M5 12h14" />
                                                <path d="M12 5v14" />
                                            </svg>
                                            Tambah Log
                                        </button>
                                    </div>
                                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                        <table id="logTable" class="min-w-full divide-y divide-gray-200 rounded-lg">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        class="w-4 sm:w-2 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                                        No</th>
                                                    <th
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        Judul</th>
                                                    <th
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        Tanggal</th>
                                                    <th
                                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                        Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @if ($mesjid->kegiatanDakwah->isEmpty())
                                                    <tr>
                                                        <td colspan="4" class="px-6 py-3 text-center text-sm text-gray-500">
                                                            Belum ada data
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($mesjid->kegiatanDakwah as $index => $kegiatan)
                                                        <tr>
                                                            <td class="px-6 py-3 text-sm text-center font-medium text-gray-800">
                                                                {{ $index + 1 }}
                                                            </td>
                                                            <td class="px-6 py-3 text-sm font-medium text-gray-800">
                                                                {{ $kegiatan->judul }}
                                                            </td>
                                                            <td class="px-6 py-3 text-sm font-medium text-gray-800">
                                                                {{ $kegiatan->tanggal->format('d M Y') }}
                                                            </td>
                                                            <td
                                                                class="flex gap-x-3 justify-end px-6 py-3 text-end text-sm font-medium">
                                                                <button type="button"
                                                                    onclick="openDetailLogModal('{{ addslashes($kegiatan->judul) }}', '{{ addslashes($kegiatan->deskripsi) }}', '{{ $kegiatan->tanggal->format('d M Y') }}', '{{ addslashes($kegiatan->catatan ?? '') }}')"
                                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gray-800 text-white hover:bg-gray-900 focus:outline-hidden focus:bg-gray-900 disabled:opacity-50 disabled:pointer-events-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                        height="18" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="lucide lucide-eye">
                                                                        <path
                                                                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                                                        <circle cx="12" cy="12" r="3" />
                                                                    </svg>
                                                                </button>
                                                                <button type="button"
                                                                    onclick="openEditLogModal({{ $kegiatan->id }}, '{{ addslashes($kegiatan->judul) }}', '{{ addslashes($kegiatan->deskripsi) }}', '{{ $kegiatan->tanggal->format('Y-m-d') }}', '{{ addslashes($kegiatan->catatan ?? '') }}')"
                                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-hidden focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none">
                                                                    <svg width="16" height="16" viewBox="0 0 14 14" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M13.0417 13.0417H8.45837M0.958374 13.0417L4.50004 12.2083L12.2441 4.46426C12.5695 4.13881 12.5695 3.61118 12.2441 3.28574L10.7143 1.75592C10.3889 1.43048 9.86121 1.43048 9.53579 1.75592L1.79171 9.5L0.958374 13.0417Z" />
                                                                    </svg>
                                                                </button>
                                                                <button type="button"
                                                                    onclick="openDeleteLogModal({{ $kegiatan->id }})"
                                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                        height="18" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="lucide lucide-trash-2">
                                                                        <path d="M3 6h18" />
                                                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                                        <line x1="10" x2="10" y1="11" y2="17" />
                                                                        <line x1="14" x2="14" y1="11" y2="17" />
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="jemaah-tab" class="tab-content hidden">
                            <div class="pb-3">
                                <div class="sm:px-3 lg:px-4">
                                    <div class="bg-white shadow overflow-hidden">
                                        <table id="dataTable" class="min-w-full divide-y divide-gray-200 rounded-lg">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        class="w-4 sm:w-2 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                                        No
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        Nama Jemaah
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        No KTP
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                                        Pengalaman Khuruj
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @if ($jemaahs->isEmpty())
                                                    <tr>
                                                        <td colspan="6" class="px-6 py-3 text-center text-sm text-gray-500">
                                                            Belum ada data
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($jemaahs as $jemaah)
                                                        <tr>
                                                            <td class="px-6 py-3 text-sm text-center font-medium text-gray-800">
                                                                {{ ($jemaahs->currentPage() - 1) * $jemaahs->perPage() + $loop->iteration }}
                                                            </td>
                                                            <td class="px-6 py-3 text-sm font-medium text-gray-800">
                                                                {{ $jemaah->nama }}
                                                            </td>
                                                            <td class="px-6 py-3 text-sm font-medium text-gray-800">
                                                                {{ $jemaah->no_ktp }}
                                                            </td>
                                                            <td class="px-6 py-3 text-sm text-center text-gray-800">
                                                                @foreach ($jemaah->pengalamanKhuruj as $pengalaman)
                                                                    <div>{{ $pengalaman->jenis_pengalaman }}</div>
                                                                @endforeach
                                                            </td>
                                                            <td
                                                                class="flex gap-x-3 justify-end px-6 py-3 text-end text-sm font-medium">
                                                                <!-- Tombol Detail -->
                                                                <button
                                                                    onclick="openDetailJemaahModal('{{ $jemaah->nama }}', '{{ $jemaah->no_ktp }}', '{{ $jemaah->pengalamanKhuruj->pluck('jenis_pengalaman')->join(', ') }}', '{{ $jemaah->created_at->format('d M Y') }}')"
                                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gray-800 text-white hover:bg-gray-900 focus:outline-hidden focus:bg-gray-900 disabled:opacity-50 disabled:pointer-events-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                        height="18" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="lucide lucide-eye">
                                                                        <path
                                                                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                                                        <circle cx="12" cy="12" r="3" />
                                                                    </svg>
                                                                </button>

                                                                <!-- Tombol Edit -->
                                                                <button type="button"
                                                                    onclick="openEditModal('{{ $jemaah->id }}', '{{ $jemaah->nama }}', '{{ $jemaah->no_ktp }}', '{{ $jemaah->pengalamanKhuruj->pluck('jenis_pengalaman')->join(', ') }}')"
                                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-hidden focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none">
                                                                    <svg width="16" height="16" viewBox="0 0 14 14" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M13.0417 13.0417H8.45837M0.958374 13.0417L4.50004 12.2083L12.2441 4.46426C12.5695 4.13881 12.5695 3.61118 12.2441 3.28574L10.7143 1.75592C10.3889 1.43048 9.86121 1.43048 9.53579 1.75592L1.79171 9.5L0.958374 13.0417Z" />
                                                                    </svg>
                                                                </button>

                                                                <!-- Tombol Hapus -->
                                                                <button type="button"
                                                                    onclick="openModal({{ $jemaah->id }}, 'delete-jemaah-modal')"
                                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                        height="18" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="lucide lucide-trash-2">
                                                                        <path d="M3 6h18" />
                                                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                                        <line x1="10" x2="10" y1="11" y2="17" />
                                                                        <line x1="14" x2="14" y1="11" y2="17" />
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paginasi -->
                        <div class="px-6 py-4">
                            {{ $jemaahs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<!-- Tambah Modal -->
<div id="tambah-jemaah-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="tambah-jemaah-form" method="POST" action="{{ route('jemaah.store') }}">
                @csrf
                <input type="hidden" name="mesjid_id" value="{{ $mesjid->id }}">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Jemaah</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="tambah_nama_jemaah" class="block text-sm font-medium text-gray-700">Nama
                                        Jemaah</label>
                                    <input type="text" id="tambah_nama_jemaah" name="nama"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Masukkan nama jemaah">
                                </div>
                                <div>
                                    <label for="tambah_no_ktp" class="block text-sm font-medium text-gray-700">No
                                        KTP</label>
                                    <input type="text" id="tambah_no_ktp" name="no_ktp"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Masukkan nomor KTP">
                                </div>
                                <div>
                                    <label for="tambah_pengalaman_khuruj"
                                        class="block text-sm font-medium text-gray-700">Pengalaman Khuruj</label>
                                    <select id="tambah_pengalaman_khuruj" name="pengalaman_khuruj"
                                        class="mt-1 px-3 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Pilih pengalaman khuruj">
                                        <option value="3 hari">3 Hari</option>
                                        <option value="40 hari">40 Hari</option>
                                        <option value="4 bulan">4 Bulan</option>
                                        <option value="4 bulan jalan kaki">4 bulan Jalan Kaki</option>
                                        <option value="4 bulan">6 Bulan</option>
                                        <option value="negeri jauh">Negeri Jauh</option>
                                        <option value="india-pakistan-bangladesh"> 4 Bulan India-Pakistan-Bangladesh
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Simpan</button>
                    <button onclick="closeModalById('tambah-jemaah-modal')"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="edit-jemaah-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="edit-jemaah-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_jemaah_id" name="id">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Jemaah</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="edit_nama_jemaah" class="block text-sm font-medium text-gray-700">Nama
                                        Jemaah</label>
                                    <input type="text" id="edit_nama_jemaah" name="nama"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Masukkan nama jemaah">
                                </div>
                                <div>
                                    <label for="edit_no_ktp" class="block text-sm font-medium text-gray-700">No
                                        KTP</label>
                                    <input type="text" id="edit_no_ktp" name="no_ktp"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Masukkan nomor KTP">
                                </div>
                                <div>
                                    <label for="edit_pengalaman_khuruj"
                                        class="block text-sm font-medium text-gray-700">Pengalaman Khuruj</label>
                                    <select id="edit_pengalaman_khuruj" name="pengalaman_khuruj"
                                        class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Pilih pengalaman khuruj">
                                        <option value="3 hari">3 Hari</option>
                                        <option value="40 hari">40 Hari</option>
                                        <option value="4 bulan">4 Bulan</option>
                                        <option value="4 bulan jalan kaki">4 bulan Jalan Kaki</option>
                                        <option value="6 bulan">6 Bulan</option>
                                        <option value="negeri jauh">Negeri Jauh</option>
                                        <option value="india-pakistan-bangladesh"> 4 Bulan India-Pakistan-Bangladesh
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Simpan</button>
                    <button onclick="closeModalById('edit-jemaah-modal')"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambah Log Modal -->
<div id="tambah-log-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="tambah-log-form" method="POST" action="{{ route('kegiatan-dakwah.store') }}">
                @csrf
                <input type="hidden" name="mesjid_id" value="{{ $mesjid->id }}">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Log Kegiatan Dakwah</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="judul_kegiatan" class="block text-sm font-medium text-gray-700">Judul
                                        Kegiatan</label>
                                    <input type="text" id="judul_kegiatan" name="judul"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required placeholder="Masukkan judul kegiatan">
                                </div>
                                <div>
                                    <label for="deskripsi_kegiatan"
                                        class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="deskripsi_kegiatan" name="deskripsi"
                                        class="mt-1 p-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        rows="4" placeholder="Masukkan deskripsi kegiatan"></textarea>
                                </div>
                                <div>
                                    <label for="catatan_kegiatan"
                                        class="block text-sm font-medium text-gray-700">Catatan</label>
                                    <input type="text" id="catatan_kegiatan" name="catatan"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Masukkan catatan singkat">
                                </div>
                                <div>
                                    <label for="tanggal_kegiatan"
                                        class="block text-sm font-medium text-gray-700">Tanggal</label>
                                    <input type="date" id="tanggal_kegiatan" name="tanggal"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required placeholder="Pilih tanggal kegiatan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Simpan</button>
                    <button onclick="closeModalById('tambah-log-modal')"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Alamat Modal -->
<div id="edit-alamat-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="edit-alamat-form" method="POST" action="{{ route('mesjid.update', $mesjid->id) }}">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Alamat Masjid</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="edit_alamat"
                                        class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea id="edit_alamat" name="alamat"
                                        class="mt-1 p-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        rows="3" required
                                        placeholder="Masukkan alamat lengkap">{{ $mesjid->alamat }}</textarea>
                                </div>
                                <div>
                                    <label for="edit_koordinat"
                                        class="block text-sm font-medium text-gray-700">Koordinat (Opsional)</label>
                                    <input type="text" id="edit_koordinat" name="koordinat"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        value="{{ $mesjid->koordinat }}" placeholder="Masukkan koordinat (opsional)">
                                    <p class="mt-1 text-xs text-gray-500">Format: latitude,longitude (contoh:
                                        -6.200000,106.816666)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Simpan</button>
                    <button onclick="closeModalById('edit-alamat-modal')"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Jemaah Modal -->
<div id="detail-jemaah-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full">
                        <h3 id="jemaah-nama" class="text-lg font-semibold text-gray-900 mb-4"></h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700">No KTP:</p>
                                <p id="jemaah-no-ktp" class="text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Pengalaman Khuruj:</p>
                                <p id="jemaah-pengalaman" class="text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Dibuat Pada:</p>
                                <p id="jemaah-created-at" class="text-sm text-gray-900"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button onclick="closeModalById('detail-jemaah-modal')"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Detail Log Modal -->
<div id="detail-log-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full">
                        <h3 id="log-judul" class="text-xl font-bold text-gray-900 mb-4"></h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-md font-medium text-gray-700">Deskripsi:</p>
                                <p id="log-deskripsi" class="text-md text-gray-900"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Tanggal:</p>
                                <p id="log-tanggal" class="text-md text-gray-900"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Catatan:</p>
                                <p id="log-catatan" class="text-md text-gray-900"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button onclick="closeModalById('detail-log-modal')"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<x-caution-modal id="delete-jemaah-modal" title="Hapus Jemaah"
    message="Apakah Anda yakin ingin menghapus jemaah ini? Tindakan ini tidak dapat dibatalkan."
    confirmButtonId="confirm-delete-jemaah-button" confirmText="Hapus" cancelText="Batal" />

<!-- Edit Log Modal -->
<div id="edit-log-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="edit-log-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_log_id" name="id">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Log Kegiatan Dakwah</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="edit_judul_kegiatan"
                                        class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                                    <input type="text" id="edit_judul_kegiatan" name="judul"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Masukkan judul kegiatan">
                                </div>
                                <div>
                                    <label for="edit_deskripsi_kegiatan"
                                        class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="edit_deskripsi_kegiatan" name="deskripsi"
                                        class="mt-1 p-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        rows="4" placeholder="Masukkan deskripsi kegiatan"></textarea>
                                </div>
                                <div>
                                    <label for="edit_catatan_kegiatan"
                                        class="block text-sm font-medium text-gray-700">Catatan</label>
                                    <input type="text" id="edit_catatan_kegiatan" name="catatan"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Masukkan catatan singkat">
                                </div>
                                <div>
                                    <label for="edit_tanggal_kegiatan"
                                        class="block text-sm font-medium text-gray-700">Tanggal</label>
                                    <input type="date" id="edit_tanggal_kegiatan" name="tanggal"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required placeholder="Pilih tanggal kegiatan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Simpan</button>
                    <button type="button" onclick="closeModalById('edit-log-modal')"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Log Modal -->
<div id="delete-log-modal" class="fixed inset-0 z-[70] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
            <form id="delete-log-form" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete_log_id" name="id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Hapus Log Kegiatan Dakwah</h3>
                            <p class="text-sm text-gray-700">Apakah Anda yakin ingin menghapus log kegiatan dakwah ini?
                                Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus</button>
                    <button type="button" onclick="closeModalById('delete-log-modal')"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModalById(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModalById(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Example usage for specific modals
    function openTambahModal() {
        openModalById('tambah-jemaah-modal');
    }

    function closeTambahModal() {
        closeModalById('tambah-jemaah-modal');
    }

    function openEditModal(id, nama, no_ktp, pengalaman_khuruj) {
        // Populate form fields
        document.getElementById('edit_jemaah_id').value = id;
        document.getElementById('edit_nama_jemaah').value = nama;
        document.getElementById('edit_no_ktp').value = no_ktp;

        // Set the selected option in the pengalaman_khuruj dropdown
        const pengalamanSelect = document.getElementById('edit_pengalaman_khuruj');
        if (pengalaman_khuruj) {
            pengalamanSelect.value = pengalaman_khuruj;
        }

        // Dynamically set form action
        document.getElementById('edit-jemaah-form').action = `/jemaah/${id}`;

        // Open modal
        openModalById('edit-jemaah-modal');
    }

    function closeEditModal() {
        closeModalById('edit-jemaah-modal');
    }

    document.getElementById('tambah-jemaah-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw new Error(err.message || 'Network response was not ok'); });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    closeTambahModal();
                    alert(data.message || 'Data berhasil ditambahkan!');
                    window.location.reload();
                } else {
                    throw new Error(data.message || 'Gagal menambahkan data.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Terjadi kesalahan saat menambahkan data.');
            });
    });

    document.getElementById('edit-jemaah-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw new Error(err.message || 'Network response was not ok'); });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    closeEditModal();
                    alert(data.message || 'Data berhasil diupdate!');
                    window.location.reload();
                } else {
                    throw new Error(data.message || 'Gagal mengupdate data.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Terjadi kesalahan saat mengupdate data.');
            });
    });

    document.getElementById('edit-log-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'X-HTTP-Method-Override': 'PUT'
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal mengupdate log.');
                }
            })
            .catch(error => {
                alert(error.message || 'Terjadi kesalahan saat mengupdate log.');
            });
    });

    document.getElementById('delete-log-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'X-HTTP-Method-Override': 'DELETE'
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal menghapus log.');
                }
            })
            .catch(error => {
                alert(error.message || 'Terjadi kesalahan saat menghapus log.');
            });
    });

    function showTab(tabId) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));

        // Remove active class from all buttons
        document.querySelectorAll('[id$="-tab-button"]').forEach(button => button.classList.remove('text-gray-900', 'border-blue-500'));
        document.querySelectorAll('[id$="-tab-button"]').forEach(button => button.classList.add('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300'));

        // Show the selected tab
        document.getElementById(tabId).classList.remove('hidden');

        // Add active class to the selected button
        document.getElementById(`${tabId}-button`).classList.add('text-gray-900', 'border-blue-500');

        // Show or hide controls based on the tab
        const jemaahControls = document.getElementById('jemaah-controls');
        if (tabId === 'jemaah-tab') {
            jemaahControls.classList.remove('hidden');
        } else {
            jemaahControls.classList.add('hidden');
        }
    }

    // Show the default tab on page load
    document.addEventListener('DOMContentLoaded', () => {
        showTab('log-tab');
    });

    function openTambahLogModal() {
        openModalById('tambah-log-modal');
    }

    function closeTambahLogModal() {
        closeModalById('tambah-log-modal');
    }

    function openEditAlamatModal() {
        openModalById('edit-alamat-modal');
    }

    function closeEditAlamatModal() {
        closeModalById('edit-alamat-modal');
    }

    function openDetailJemaahModal(nama, noKtp, pengalaman, createdAt) {
        // Populate modal content
        document.getElementById('jemaah-nama').textContent = nama;
        document.getElementById('jemaah-no-ktp').textContent = noKtp || 'Tidak tersedia';
        document.getElementById('jemaah-pengalaman').textContent = pengalaman || 'Tidak tersedia';
        document.getElementById('jemaah-created-at').textContent = createdAt || 'Tidak tersedia';

        // Show modal
        openModalById('detail-jemaah-modal');
    }

    function closeDetailJemaahModal() {
        closeModalById('detail-jemaah-modal');
    }

    function openDetailLogModal(judul, deskripsi, tanggal, catatan) {
        // Populate modal content
        document.getElementById('log-judul').textContent = judul;
        document.getElementById('log-deskripsi').textContent = deskripsi || 'Tidak tersedia';
        document.getElementById('log-tanggal').textContent = tanggal || 'Tidak tersedia';

        // Populate catatan (single phrase) content
        document.getElementById('log-catatan').textContent = catatan || 'Tidak ada catatan.';

        // Show modal
        openModalById('detail-log-modal');
    }

    function closeDetailLogModal() {
        closeModalById('detail-log-modal');
    }

    let dataIdToDelete = null;

    function openModal(id, modalId) {
        dataIdToDelete = id;
        openModalById(modalId);
    }

    function closeModal(modalId) {
        dataIdToDelete = null;
        closeModalById(modalId);
    }

    document.querySelectorAll('[id^="confirm-delete-"]').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.id.replace('confirm-delete-', 'delete-');
            if (dataIdToDelete) {
                fetch(`/jemaah/${dataIdToDelete}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        response.json().then(data => {
                            alert("Gagal menghapus data: " + (data.message || "Kesalahan tidak diketahui."));
                        });
                    }
                }).catch(error => {
                    alert("Terjadi kesalahan saat menghapus data.");
                }).finally(() => {
                    closeModal(modalId);
                });
            }
        });
    });

    function openEditLogModal(id, judul, deskripsi, tanggal, catatan) {
        document.getElementById('edit_log_id').value = id;
        document.getElementById('edit_judul_kegiatan').value = judul;
        document.getElementById('edit_deskripsi_kegiatan').value = deskripsi;
        document.getElementById('edit_tanggal_kegiatan').value = tanggal;
        document.getElementById('edit_catatan_kegiatan').value = catatan;
        document.getElementById('edit-log-form').action = `/kegiatan-dakwah/${id}`;
        openModalById('edit-log-modal');
    }

    function openDeleteLogModal(id) {
        document.getElementById('delete_log_id').value = id;
        openModalById('delete-log-modal');
    }
</script>

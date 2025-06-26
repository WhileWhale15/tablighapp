<x-admin-layout>

    <!-- Title and Breadcrumb -->
    <div class="bg-gray-100 py-4 space-y-2">
        <h1 class="py-3 text-3xl sm:text-5xl font-semibold text-gray-800">Daftar Kecamatan</h1>
        <x-breadcrumb :breadcrumbs="[
        ['name' => 'Kelola Data', 'url' => route('data.index')],
    ]" />
    </div>

    <div class="py-8  sm:px-6 lg:px-0">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white shadow border border-gray-200 rounded-lg divide-y divide-gray-200">
                        <div class="py-3 px-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                            <x-admin.search-input id="searchInput" placeholder="Cari kecamatan..."
                                onkeyup="searchTable()" class="w-full sm:w-auto" />

                            <button onclick="openTambahModal()"
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

                        <!-- Tabel -->
                        <div class="overflow-x-auto">
                            <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="w-4 sm:w-2 px-4 sm:px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            No</th>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            Nama Kecamatan</th>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Jumlah Kelurahan</th>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Jumlah Mesjid</th>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Dibuat Pada</th>
                                        <th
                                            class="px-4 sm:px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($kecamatans as $kecamatan)
                                        <tr>
                                            <td class="px-4 sm:px-6 py-3 text-sm text-center font-medium text-gray-800">
                                                {{ ($kecamatans->currentPage() - 1) * $kecamatans->perPage() + $loop->iteration }}
                                            </td>
                                            <td class="px-4 sm:px-6 py-3 text-sm font-medium text-gray-800">
                                                {{ $kecamatan->nama_kecamatan }}
                                            </td>
                                            <td class="px-4 sm:px-6 py-3 text-sm text-center font-medium text-gray-800">
                                                {{ $kecamatan->kelurahans_count }}
                                            </td>
                                            <td class="px-4 sm:px-6 py-3 text-sm text-center font-medium text-gray-800">
                                                {{ $kecamatan->mesjids_count }}
                                            </td>
                                            <td class="px-4 sm:px-6 py-3 text-sm text-center text-gray-800">
                                                {{ $kecamatan->created_at->format('d M Y') }}
                                            </td>
                                            <td
                                                class="flex gap-x-3 justify-end px-4 sm:px-6 py-3 text-end text-sm font-medium">
                                                <a href="{{ route('kelurahan.index', ['kecamatan_id' => $kecamatan->id]) }}"
                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gray-800 text-white hover:bg-gray-900 focus:outline-hidden focus:bg-gray-900 disabled:opacity-50 disabled:pointer-events-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-eye">
                                                        <path
                                                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                                </a>
                                                <button type="button"
                                                    onclick="openEditModal({{ $kecamatan->id }}, '{{ $kecamatan->nama_kecamatan }}')"
                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-hidden focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none">
                                                    <svg width="16" height="16" viewBox="0 0 14 14" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.0417 13.0417H8.45837M0.958374 13.0417L4.50004 12.2083L12.2441 4.46426C12.5695 4.13881 12.5695 3.61118 12.2441 3.28574L10.7143 1.75592C10.3889 1.43048 9.86121 1.43048 9.53579 1.75592L1.79171 9.5L0.958374 13.0417Z" />
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    onclick="openDeleteKecamatanModal({{ $kecamatan->id }})"
                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginasi -->
                        <div class="px-6 py-4">
                            {{ $kecamatans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<!-- Tambah Modal -->
<div id="tambah-kecamatan-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="tambah-kecamatan-form" method="POST" action="{{ route('data.store') }}">
                @csrf
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Tambah Kecamatan
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="tambah_nama_kecamatan"
                                        class="block text-sm font-medium text-gray-700">Nama Kecamatan</label>
                                    <input type="text" id="tambah_nama_kecamatan" name="nama_kecamatan"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                        Simpan
                    </button>
                    <button type="button" onclick="closeTambahModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="edit-kecamatan-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="edit-kecamatan-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_kecamatan_id" name="id">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Kecamatan</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="edit_nama_kecamatan"
                                        class="block text-sm font-medium text-gray-700">Nama Kecamatan</label>
                                    <input type="text" id="edit_nama_kecamatan" name="nama_kecamatan"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                        Simpan
                    </button>
                    <button type="button" onclick="closeEditModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-caution-modal id="delete-kecamatan-modal" title="Hapus Kecamatan"
    message="Apakah Anda yakin ingin menghapus kecamatan ini? Tindakan ini tidak dapat dibatalkan."
    confirmButtonId="confirm-delete-kecamatan-button" confirmText="Hapus" cancelText="Batal" />

<script>
    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        document.querySelectorAll("#dataTable tbody tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
        });
    }

    let kecamatanIdToDelete = null;

    function openDeleteKecamatanModal(id) {
        kecamatanIdToDelete = id; // Store the ID of the Kecamatan
        const modal = document.getElementById('delete-kecamatan-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteKecamatanModal() {
        kecamatanIdToDelete = null; // Reset the ID
        const modal = document.getElementById('delete-kecamatan-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.getElementById('confirm-delete-kecamatan-button').addEventListener('click', function () {
        if (kecamatanIdToDelete) {
            fetch(`/data/${kecamatanIdToDelete}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => {
                if (response.ok) {
                    location.reload(); // Reload the page after successful deletion
                } else {
                    response.json().then(data => {
                        alert("Gagal menghapus kecamatan: " + (data.message || "Kesalahan tidak diketahui."));
                    });
                }
            }).catch(error => {
                alert("Terjadi kesalahan saat menghapus kecamatan.");
            }).finally(() => {
                closeDeleteKecamatanModal(); // Close the modal after the request
            });
        }
    });

    function deleteKecamatan(id) {
        if (confirm("Apakah Anda yakin ingin menghapus kecamatan ini?")) {
            fetch(`/data/${id}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content }
            })
                .then(res => res.json())
                .then(data => data.success ? (alert("Berhasil dihapus!"), location.reload()) : alert("Gagal menghapus."))
                .catch(() => alert("Terjadi kesalahan saat menghapus."));
        }
    }

    function openEditModal(id, nama) {
        // Close any open dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
            dropdown.style.display = 'none';
        });

        // Reset Alpine.js isOpen state for all dropdowns
        document.querySelectorAll('[x-data]').forEach(el => {
            if (el.__x) {
                el.__x.$data.isOpen = false;
            }
        });

        // Populate form fields
        document.getElementById('edit_kecamatan_id').value = id;
        document.getElementById('edit_nama_kecamatan').value = nama;

        // Dynamically set form action
        document.getElementById('edit-kecamatan-form').action = `/data/${id}`;

        // Show modal
        const modal = document.getElementById('edit-kecamatan-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        const modal = document.getElementById('edit-kecamatan-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Add form submission handler
    document.getElementById('edit-kecamatan-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        // Convert FormData to URLSearchParams
        const params = new URLSearchParams();
        for (const pair of formData) {
            params.append(pair[0], pair[1]);
        }

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json'
            },
            body: params
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Close modal first
                    closeEditModal();

                    // Show success message
                    alert(data.message || 'Data berhasil diupdate!');

                    // Then reload the page
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

    function openTambahModal() {
        // Show modal
        const modal = document.getElementById('tambah-kecamatan-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeTambahModal() {
        const modal = document.getElementById('tambah-kecamatan-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>

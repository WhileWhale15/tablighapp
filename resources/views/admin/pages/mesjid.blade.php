<x-admin-layout>

    <!-- Title and Breadcrumb -->
    <div class="bg-gray-100 py-4 space-y-2">
        <h1 class="py-3 text-5xl font-semibold text-gray-800">Daftar Mesjid di
            {{ $kelurahan->nama_kelurahan }}
        </h1>
        <x-breadcrumb :breadcrumbs="[
        ['name' => 'Kelola Data', 'url' => route('data.index')],
        ['name' => 'Daftar Kelurahan', 'url' => route('kelurahan.index', ['kecamatan_id' => $kelurahan->kecamatan_id])],
        ['name' => 'Daftar Mesjid', 'url' => route('mesjid.index', ['kelurahan_id' => $kelurahan->id])],
    ]" />
    </div>

    <div class="py-8">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white shadow border border-gray-200 rounded-lg divide-y divide-gray-200">
                        <div class="py-3 px-4">
                            <div class="flex justify-between items-center">
                                <x-admin.search-input id="searchInput" placeholder="Cari mesjid..."
                                    onkeyup="searchTable()" />

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
                        </div>

                        <!-- Tabel -->
                        <div class="overflow-hidden">
                            <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="w-4 sm:w-2 px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            No</th>
                                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            Nama Mesjid</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Jumlah Jemaah</th>
                                        <th
                                            class="w-2/6  px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Alamat</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Dibuat Pada</th>
                                        <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($mesjids as $mesjid)
                                        <tr>
                                            <td class="px-6 py-3 text-sm text-center font-medium text-gray-800">
                                                {{ ($mesjids->currentPage() - 1) * $mesjids->perPage() + $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-3 text-sm font-medium text-gray-800">
                                                {{ $mesjid->nama_mesjid }}
                                            </td>
                                            <td class="px-6 py-3 text-sm text-center font-medium text-gray-800">
                                                {{ $mesjid->jemaah_count }}
                                            </td>
                                            <td class="w-2/6 px-6 py-3 text-sm font-medium text-gray-800">
                                                {{ $mesjid->alamat ?? 'Alamat belum ditambahkan' }}
                                            </td>
                                            <td class="px-6 py-3 text-sm text-center text-gray-800">
                                                {{ $mesjid->created_at->format('d M Y') }}
                                            </td>
                                            <td class="flex gap-x-3 justify-end px-6 py-3 text-end text-sm font-medium">
                                                <a href="{{ route('jemaah.index', ['mesjid_id' => $mesjid->id]) }}"
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
                                                    onclick="openEditModal({{ $mesjid->id }}, '{{ $mesjid->nama_mesjid }}', '{{ $mesjid->alamat }}')"
                                                    class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-hidden focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none">
                                                    <svg width="16" height="16" viewBox="0 0 14 14" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.0417 13.0417H8.45837M0.958374 13.0417L4.50004 12.2083L12.2441 4.46426C12.5695 4.13881 12.5695 3.61118 12.2441 3.28574L10.7143 1.75592C10.3889 1.43048 9.86121 1.43048 9.53579 1.75592L1.79171 9.5L0.958374 13.0417Z" />
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    onclick="openModal({{ $mesjid->id }}, 'delete-mesjid-modal')"
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
                            <div class="flex justify-center">
                                {{ $mesjids->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<!-- Tambah Modal -->
<div id="tambah-mesjid-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="tambah-mesjid-form" method="POST" action="{{ route('mesjid.store') }}">
                @csrf
                <input type="hidden" name="kelurahan_id" value="{{ $kelurahan->id }}">
                <input type="hidden" name="kecamatan_id" value="{{ $kelurahan->kecamatan_id }}">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Tambah Mesjid
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="tambah_nama_mesjid" class="block text-sm font-medium text-gray-700">Nama
                                        Mesjid</label>
                                    <input type="text" id="tambah_nama_mesjid" name="nama_mesjid"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="tambah_alamat_mesjid"
                                        class="block text-sm font-medium text-gray-700">Alamat
                                        (Opsional)</label>
                                    <textarea id="tambah_alamat_mesjid" name="alamat"
                                        class="mt-1 p-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
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
<div id="edit-mesjid-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="edit-mesjid-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_mesjid_id" name="id">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Mesjid</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="edit_nama_mesjid" class="block text-sm font-medium text-gray-700">Nama
                                        Mesjid</label>
                                    <input type="text" id="edit_nama_mesjid" name="nama_mesjid"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="edit_alamat_mesjid"
                                        class="block text-sm font-medium text-gray-700">Alamat
                                        (Opsional)</label>
                                    <textarea id="edit_alamat_mesjid" name="alamat"
                                        class="mt-1 p-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
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

<!-- Duplicate Confirmation Modal -->
<div id="duplicate-confirmation-modal" class="fixed inset-0 z-[70] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-alert-triangle text-red-600">
                            <path
                                d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                            </path>
                            <line x1="12" x2="12" y1="9" y2="13"></line>
                            <line x1="12" x2="12.01" y1="17" y2="17"></line>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Data Duplikat Ditemukan
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-800">
                                Data dengan nama yang sama sudah ada di wilayah ini:
                            </p>
                            <ul class="mt-2 text-sm text-gray-500">
                                <li><strong>ID:</strong> <span id="duplicate-data-id"></span></li>
                                <li><strong>Nama:</strong> <span id="duplicate-data-name"></span></li>
                                <li><strong>Alamat:</strong> <span id="duplicate-data-address"></span></li>
                            </ul>
                            <p class="mt-4 text-sm text-gray-800 font-semibold">
                                Apakah Anda yakin ingin menambahkan data baru dengan nama yang sama?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button id="confirm-add-duplicate"
                    class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                    Tambahkan Data Baru
                </button>
                <button type="button" onclick="closeDuplicateConfirmationModal()"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<x-caution-modal id="delete-mesjid-modal" title="Hapus Mesjid"
    message="Apakah Anda yakin ingin menghapus mesjid ini? Tindakan ini tidak dapat dibatalkan."
    confirmButtonId="confirm-delete-mesjid-button" confirmText="Hapus" cancelText="Batal" />

<script>
    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        document.querySelectorAll("#dataTable tbody tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
        });
    }

    function openEditModal(id, nama, alamat) {
        // Populate form fields
        document.getElementById('edit_mesjid_id').value = id;
        document.getElementById('edit_nama_mesjid').value = nama;
        document.getElementById('edit_alamat_mesjid').value = alamat || ''; // Handle null or undefined address

        // Dynamically set form action
        document.getElementById('edit-mesjid-form').action = `/mesjid/${id}`;

        // Show modal
        const modal = document.getElementById('edit-mesjid-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        const modal = document.getElementById('edit-mesjid-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function openTambahModal() {
        const modal = document.getElementById('tambah-mesjid-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeTambahModal() {
        const modal = document.getElementById('tambah-mesjid-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function closeDuplicateConfirmationModal() {
        const modal = document.getElementById('duplicate-confirmation-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.getElementById('tambah-mesjid-form').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const namaMesjid = document.getElementById('tambah_nama_mesjid').value.trim();

        if (!namaMesjid) {
            alert('Nama Mesjid tidak boleh kosong.');
            return; // Stop execution if the input is invalid
        }

        // Proceed with the fetch request
        const form = e.target;
        const formData = new FormData(form);

        showLoading();
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(response => {
                hideLoading();
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
                } else if (data.duplicate) {
                    // Populate duplicate modal fields
                    const duplicateData = data.data; // Access the duplicate data object
                    document.getElementById('duplicate-data-id').textContent = duplicateData.id;
                    document.getElementById('duplicate-data-name').textContent = duplicateData.nama_mesjid;
                    document.getElementById('duplicate-data-address').textContent = duplicateData.alamat || 'Alamat belum ditambahkan';

                    // Show duplicate confirmation modal
                    const modal = document.getElementById('duplicate-confirmation-modal');
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');

                    // Handle confirmation button
                    document.getElementById('confirm-add-duplicate').onclick = function () {
                        form.submit(); // Submit the form again to add duplicate data
                    };
                } else {
                    throw new Error(data.message || 'Gagal menambahkan data.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Terjadi kesalahan. Silakan coba lagi.');
            });
    });

    document.getElementById('edit-mesjid-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        showLoading();
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(response => {
                hideLoading();
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
                alert(error.message || 'Terjadi kesalahan. Silakan coba lagi.');
            });
    });

    function showLoading() {
        const loadingOverlay = document.createElement('div');
        loadingOverlay.id = 'loading-overlay';
        loadingOverlay.style.position = 'fixed';
        loadingOverlay.style.top = '0';
        loadingOverlay.style.left = '0';
        loadingOverlay.style.width = '100%';
        loadingOverlay.style.height = '100%';
        loadingOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        loadingOverlay.style.zIndex = '9999';
        loadingOverlay.style.display = 'flex';
        loadingOverlay.style.justifyContent = 'center';
        loadingOverlay.style.alignItems = 'center';
        loadingOverlay.innerHTML = '<div class="spinner"></div>';
        document.body.appendChild(loadingOverlay);
    }

    function hideLoading() {
        const loadingOverlay = document.getElementById('loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.remove();
        }
    }

    let dataIdToDelete = null;

    function openModal(id, modalId) {
        dataIdToDelete = id; // Store the ID of the data to delete
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(modalId) {
        dataIdToDelete = null; // Reset the ID
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.querySelectorAll('[id^="confirm-delete-"]').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.id.replace('confirm-delete-', 'delete-');
            if (dataIdToDelete) {
                fetch(`/mesjid/${dataIdToDelete}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload(); // Reload the page after successful deletion
                    } else {
                        response.json().then(data => {
                            alert("Gagal menghapus data: " + (data.message || "Kesalahan tidak diketahui."));
                        });
                    }
                }).catch(error => {
                    alert("Terjadi kesalahan saat menghapus data.");
                }).finally(() => {
                    closeModal(modalId); // Close the modal after the request
                });
            }
        });
    });
</script>

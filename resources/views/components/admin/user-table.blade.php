<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="bg-white shadow border border-gray-200 rounded-lg divide-y divide-gray-200">
                <div class="py-3 px-4">
                    <x-admin.search-input id="searchInput" placeholder="Cari pengguna..." onkeyup="searchTable()" />
                </div>
                <div class="overflow-hidden">
                    <table id="userTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-4 sm:w-2 px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    No</th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Nama</th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Email</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Role</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Dibuat Pada</th>
                                <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-3 text-sm text-center font-medium text-gray-800">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-3 text-sm font-medium text-gray-800">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-800 ">{{ $user->email }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-center text-gray-800">
                                        {{ $user->getRoleNames()->first() ?? 'No Role Assigned' }}
                                    </td>
                                    <td class="px-6 py-3 text-sm text-center text-gray-800">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-3 flex justify-end gap-x-3 text-end text-sm font-medium">
                                        <button type="button"
                                            onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')"
                                            class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-hidden focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none">
                                            <svg width="16" height="16" viewBox="0 0 14 14" fill="none"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0417 13.0417H8.45837M0.958374 13.0417L4.50004 12.2083L12.2441 4.46426C12.5695 4.13881 12.5695 3.61118 12.2441 3.28574L10.7143 1.75592C10.3889 1.43048 9.86121 1.43048 9.53579 1.75592L1.79171 9.5L0.958374 13.0417Z" />
                                            </svg>
                                        </button>
                                        <button type="button" onclick="openDeleteModal({{ $user->id }})"
                                            class="p-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
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
                        </tbody>
                    </table>
                </div>
                <div class="py-3 px-4 flex justify-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="edit-user-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="flex min-h-full items-center justify-center">
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <form id="edit-user-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="id">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Pengguna</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text" id="edit_name" disabled
                                        class="mt-1 block w-full rounded-md text-gray-500 border-gray-300 bg-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" id="edit_email" disabled
                                        class="mt-1 block w-full rounded-md text-gray-500 border-gray-300 bg-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="edit_role" class="block text-sm font-medium text-gray-700">Role</label>
                                    <select id="edit_role" name="role"
                                        class="mt-1 px-3 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Simpan</button>
                    <button type="button" onclick="closeEditModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div id="delete-user-modal" class="fixed inset-0 z-[60] hidden">
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
                        <h3 class="text-xl font-semibold text-gray-900 mt-2 mb-4">Hapus Pengguna</h3>
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button id="confirm-delete-button"
                    class="inline-flex w-full justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                    Hapus
                </button>
                <button type="button" onclick="closeDeleteModal()"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#userTable tbody tr");
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
        });
    }

    let userIdToDelete = null;

    function openDeleteModal(userId) {
        userIdToDelete = userId; // Simpan ID pengguna
        const modal = document.getElementById('delete-user-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        userIdToDelete = null; // Reset ID pengguna
        const modal = document.getElementById('delete-user-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.getElementById('confirm-delete-button').addEventListener('click', function () {
        if (userIdToDelete) {
            fetch(`/users/${userIdToDelete}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }).then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    response.json().then(data => {
                        alert("Gagal menghapus pengguna: " + (data.message || "Kesalahan tidak diketahui."));
                    });
                }
            }).catch(error => {
                alert("Terjadi kesalahan saat menghapus pengguna.");
            }).finally(() => {
                closeDeleteModal(); // Tutup modal setelah permintaan selesai
            });
        }
    });

    function openEditModal(id, name, email, role) {
        // Isi field formulir
        document.getElementById('edit_user_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;

        // Setel peran saat ini sebagai yang dipilih di dropdown
        const roleDropdown = document.getElementById('edit_role');
        Array.from(roleDropdown.options).forEach(option => {
            option.selected = option.value.toLowerCase() === role.toLowerCase();
        });

        // Setel action formulir
        document.getElementById('edit-user-form').action = `/users/${id}`;

        // Tampilkan modal
        const modal = document.getElementById('edit-user-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        const modal = document.getElementById('edit-user-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Tambahkan event listener untuk pengiriman formulir
    document.getElementById('edit-user-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = e.target;
        const userId = document.getElementById('edit_user_id').value;

        fetch(`/users/${userId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                role: document.getElementById('edit_role').value
            })
        }).then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Gagal memperbarui peran pengguna.');
            }
        });
    });
</script>
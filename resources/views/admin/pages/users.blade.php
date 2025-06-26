<x-admin-layout>

    <!-- Title and Breadcrumb -->
    <div class="bg-gray-100 py-4 space-y-2">
        <h1 class="py-3 text-5xl font-semibold text-gray-800">Kelola Pengguna</h1>
        <x-breadcrumb :breadcrumbs="[
        ['name' => 'Kelola Pengguna', 'url' => route('users.index')],
    ]" />
    </div>

    <div class="py-8">
        <x-admin.user-table :users="$users" />
</x-admin-layout>

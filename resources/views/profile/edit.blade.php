<x-admin-layout>

    <!-- Title and Breadcrumb -->
    <div class="bg-gray-100">
        <h1 class="py-3 text-5xl font-semibold text-gray-800">Pengaturan Profil</h1>
        <nav class="text-sm font-medium text-gray-500 mt-1">
            <ol class="inline-flex space-x-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Beranda</a>
                </li>
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li>
                    <span class="text-gray-700">Pengaturan Profil</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="py-8">
        <div class="space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
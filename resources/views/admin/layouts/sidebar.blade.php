<!-- Sidebar Component with Alpine.js -->
<div x-data="{ open: false }" class="fixed h-screen z-40">

    <!-- Hamburger for Mobile -->
    <div class="sm:hidden p-4 bg-[#191D23] text-white">
        <button @click="open = !open" class="focus:outline-none" aria-label="Toggle navigation drawer">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-menu">
                <path d="M4 6h16" />
                <path d="M4 12h16" />
                <path d="M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-x">
                <path d="M18 6 6 18" />
                <path d="M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Drawer -->
    <nav x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform -translate-x-full"
        class="fixed top-0 left-0 z-50 h-full w-64 bg-[#191D23] text-white shadow-lg overflow-y-auto sm:hidden">

        <!-- User Info -->
        <div class="flex items-center space-x-4 p-4 border-b border-gray-700">
            <img src="{{ Auth::user()->profile_picture ?? '/default-profile.png' }}" alt="User Avatar"
                class="h-10 w-10 rounded-full object-cover" />
            <div>
                <p class="font-semibold">{{ Auth::user()->name }}</p>
            </div>
        </div>

        <!-- Nav Links -->
        <ul class="mt-4 space-y-2 px-4">
            <li><x-admin.nav-link href="{{ route('dashboard') }}">Dashboard</x-admin.nav-link></li>
            <li><x-admin.nav-link href="{{ route('users.index') }}">Kelola Pengguna</x-admin.nav-link></li>
            <li><x-admin.nav-link href="{{ route('data.index') }}">Kelola Data</x-admin.nav-link></li>
        </ul>

        <!-- Settings -->
        <div class="mt-auto p-4 border-t border-gray-700">
            <h3 class="text-gray-400 mb-2">Settings</h3>
            <ul class="space-y-2">
                <li>
                    <x-admin.nav-link href="{{ route('admin-profile.edit') }}">Pengaturan Profil</x-admin.nav-link>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-3 py-2 rounded hover:bg-gray-700 focus:bg-gray-700 focus:outline-none">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Persistent Sidebar (Desktop) -->
    <nav :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
        class="bg-[#191D23] text-white fixed h-screen w-64 px-6 py-2 flex flex-col shadow-lg transform transition-transform duration-300 z-50 sm:translate-x-0 sm:static sm:block"
        @click.away="open = false" @keydown.window.escape="open = false">

        <!-- Logo -->
        <div class="flex items-center justify-start h-16">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <x-application-logo class="h-12 fill-current text-gray-100" />
                <h2 class="text-2xl font-bold text-gray-100 pt-1">TablighApp</h2>
            </a>
        </div>

        <!-- Desktop Nav Links -->
        <div class="flex-1 overflow-y-auto">
            <ul class="my-6 space-y-2">
                <li>
                    <x-admin.nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        @click="open = false" class="flex items-center px-4 py-2 text-md font-medium hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-house">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                            <path
                                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                        <span class="pl-4">Beranda</span>
                    </x-admin.nav-link>
                </li>
                <li>
                    <x-admin.nav-link :href="route('users.index')" :active="request()->routeIs('users.index')"
                        @click="open = false" class="flex items-center px-4 py-2 font-medium hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-users">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <span class="pl-4">Kelola Pengguna</span>
                    </x-admin.nav-link>
                </li>
                <li>
                    <x-admin.nav-link :href="route('data.index')" :active="request()->routeIs('data.index')"
                        @click="open = false" class="flex items-center px-4 py-2 font-medium hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-database">
                            <ellipse cx="12" cy="5" rx="9" ry="3" />
                            <path d="M3 5V19A9 3 0 0 0 21 19V5" />
                            <path d="M3 12A9 3 0 0 0 21 12" />
                        </svg>
                        <span class="pl-4">Kelola Data</span>
                    </x-admin.nav-link>
                </li>
                <li>
                    <x-admin.nav-link :href="route('admin.documentation')"
                        :active="request()->routeIs('admin.documentation')" @click="open = false"
                        class="flex items-center px-4 py-2 font-medium hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-book-open-icon lucide-book-open">
                            <path d="M12 7v14" />
                            <path
                                d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z" />
                        </svg>
                        <span class="pl-4">Dokumentasi</span>
                    </x-admin.nav-link>
                </li>
            </ul>
        </div>

        <!-- Settings (Desktop) -->
        <div class="mt-auto mb-4">
            <h3 class="text-md text-gray-400">Pengaturan</h3>
            <ul class="mt-2 space-y-2">
                <li>
                    <x-admin.nav-link :href="route('admin-profile.edit')"
                        :active="request()->routeIs('admin-profile.edit')" @click="open = false"
                        class="flex items-center px-4 py-2 font-medium hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-circle-user-round">
                            <path d="M18 20a6 6 0 0 0-12 0" />
                            <circle cx="12" cy="10" r="4" />
                            <circle cx="12" cy="12" r="10" />
                        </svg>
                        <span class="pl-4">Pengaturan Profil</span>
                    </x-admin.nav-link>
                </li>
            </ul>
        </div>
    </nav>
</div>

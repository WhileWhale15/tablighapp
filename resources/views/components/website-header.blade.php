<div class="relative flex items-center w-full px-12 py-3 bg-gray-100 shadow-md max-md:px-8 max-sm:px-4">
    <!-- Logo Section -->
    <div class="flex items-center justify-start h-12 shrink-0 pb-2">
        <a href="{{ route('user.home') }}" class="flex items-center space-x-3">
            <x-application-logo class="h-12 fill-current" />
            <h2 class="hidden text-2xl font-bold text-gray-900 pt-2 md:block lg:block">TablighApp</h2>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 max-md:hidden">
        <!-- Navigation Links -->
        <nav class="mx-auto">
            <ul class="flex flex-row gap-2">
                <li>
                    <x-web.nav-link :href="route('user.home')" :active="request()->routeIs('user.home')"
                        class="flex items-center px-4 py-2 text-md rounded-lg hover:bg-gray-200 transition">
                        <h3 class="text-gray-900">Beranda</h3>
                    </x-web.nav-link>
                </li>
                <li>
                    <x-web.nav-link :href="route('user.schedule')" :active="request()->routeIs('user.schedule')"
                        class="flex items-center px-4 py-2 text-md rounded-lg hover:bg-gray-200 transition">
                        <h3 class="text-gray-900">Jadwal</h3>
                    </x-web.nav-link>
                </li>
                <li>
                    <x-web.nav-link :href="route('user.direktori')" :active="request()->routeIs('user.direktori')"
                        class="flex items-center px-4 py-2 text-md rounded-lg hover:bg-gray-200 transition">
                        <h3 class="text-gray-900">Direktori</h3>
                    </x-web.nav-link>
                </li>
                <li>
                    <x-web.nav-link :href="route('user.about')" :active="request()->routeIs('user.about')"
                        class="flex items-center px-4 py-2 text-md rounded-lg hover:bg-gray-200 transition">
                        <h3 class="text-gray-900">Tentang</h3>
                    </x-web.nav-link>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Right Section: Profile and Mobile Menu -->
    <div class="flex items-center ml-auto gap-2">
        <x-ui.profile-dropdown />
        <button type="button" class="hidden max-md:block" onclick="toggleMobileMenu()" aria-label="Buka menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-[24px] h-[24px]" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 6l16 0"></path>
                <path d="M4 12l16 0"></path>
                <path d="M4 18l16 0"></path>
            </svg>
        </button>
    </div>
</div>

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed inset-0 z-50 bg-gray-100 p-0 hidden flex flex-col">
    <div class="flex items-center justify-between px-6 py-3 bg-white border-b border-gray-200 shadow-md">
        <div class="flex items-center gap-3">
            <img src="/Logo.png" alt="Logo" class="h-12 w-12 rounded-full">
            <div>
                <div class="font-semibold text-gray-900">TablighApp</div>
                <div class="text-xs text-gray-500">Menu</div>
            </div>
        </div>
        <button onclick="toggleMobileMenu()" class="text-gray-700 text-3xl focus:outline-none"
            aria-label="Tutup menu">&times;</button>
    </div>

    <!-- User Profile Section -->
    <div class="flex items-center gap-3 mx-3 mt-3 px-6 py-4 rounded-lg bg-white">
        @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture"
                class="h-10 w-10 rounded-full" />
        @else
            <svg class="h-10 w-10 rounded-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                <path d="M12 14c-4 0-6 2-6 4v2h12v-2c0-2-2-4-6-4z" />
            </svg>
        @endif
        <div>
            <div class="font-semibold text-gray-900">{{ Auth::user()->name ?? 'User' }}</div>
            <div class="text-xs text-gray-500">{{ Auth::user()->email ?? '' }}</div>
        </div>
    </div>
    <nav class="flex-1 overflow-y-auto m-3 py-4 px-6 rounded-lg bg-white">
        <ul class="flex flex-col gap-2">
            <li>
                <a href="{{ route('user.home') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-900 font-medium hover:bg-gray-100"
                    onclick="toggleMobileMenu()">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                    </svg>Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('user.schedule') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-900 font-medium hover:bg-gray-100"
                    onclick="toggleMobileMenu()">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>Jadwal
                </a>
            </li>
            <li>
                <a href="{{ route('user.kelurahan') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-900 font-medium hover:bg-gray-100"
                    onclick="toggleMobileMenu()">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 22s8-4 8-10V5a2 2 0 00-2-2H6a2 2 0 00-2 2v7c0 6 8 10 8 10z" />
                    </svg>Direktori Kelurahan
                </a>
            </li>
            <li>
                <a href="{{ route('user.mesjid') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-900 font-medium hover:bg-gray-100"
                    onclick="toggleMobileMenu()">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 21v-2a4 4 0 014-4h10a4 4 0 014 4v2" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 3.13a4 4 0 01.94 7.76A4 4 0 0112 7a4 4 0 01-4.94 3.89A4 4 0 008 3.13" />
                    </svg>Direktori Masjid
                </a>
            </li>
            <li>
                <a href="{{ route('user.jemaah') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-900 font-medium hover:bg-gray-100"
                    onclick="toggleMobileMenu()">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 01.94 7.76A4 4 0 0112 7a4 4 0 01-4.94 3.89A4 4 0 008 3.13" />
                    </svg>Direktori Jamaah
                </a>
            </li>
            <li>
                <a href="{{ route('user.about') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-900 font-medium hover:bg-gray-100"
                    onclick="toggleMobileMenu()">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>Tentang
                </a>
            </li>
        </ul>
    </nav>
    <!-- Bottom Actions -->
    <div class="mt-auto m-3 py-4 px-6 rounded-lg bg-white flex flex-col gap-2">
        <a href="{{ route('user-profile.show') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-900 font-medium hover:bg-gray-100">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Profile Settings
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-red-600 font-medium hover:bg-red-50">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>

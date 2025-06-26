<!-- Header Section -->
<div class="py-2 flex items-center justify-end max-md:hidden">
    <!-- Profile Dropdown -->
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="select-none text-gray-500 hover:text-gray-900 hover:bg-gray-300 flex h-10 w-10 items-center justify-center rounded-full px-1 transition focus:outline-none focus-visible:outline-none">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture"
                        class="h-8 w-8 rounded-full" />
                @else
                    <svg class="h-8 w-8 rounded-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                        <path d="M12 14c-4 0-6 2-6 4v2h12v-2c0-2-2-4-6-4z" />
                    </svg>
                @endif
            </button>
        </x-slot>

        <x-slot name="content">
            @php
                $isAdminPanel = request()->routeIs('profile.*');
            @endphp
            @if(!$isAdminPanel)
                @php
                    $profileRoute = route('user-profile.show');
                @endphp
                <x-dropdown-link :href="$profileRoute">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-circle-user-round-icon lucide-circle-user-round">
                        <path d="M18 20a6 6 0 0 0-12 0" />
                        <circle cx="12" cy="10" r="4" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    {{ __('Pengaturan Profil') }}
                </x-dropdown-link>
            @endif

            @auth
                @if(auth()->user()->hasRole('admin'))
                    @php
                        $currentRoute = Route::currentRouteName();
                        $isOnWebsite = $currentRoute === 'user.home';
                    @endphp

                    <x-dropdown-link :href="$isOnWebsite ? route('dashboard') : route('user.home')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-laptop-minimal-icon lucide-laptop-minimal">
                            <rect width="18" height="12" x="3" y="4" rx="2" ry="2" />
                            <line x1="2" x2="22" y1="20" y2="20" />
                        </svg>
                        {{ $isOnWebsite ? __('Go to Admin Panel') : __('Go to Website') }}
                    </x-dropdown-link>
                @endif
            @endauth


            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-log-out-icon lucide-log-out">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" x2="9" y1="12" y2="12" />
                    </svg>
                    {{ __('Keluar') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>

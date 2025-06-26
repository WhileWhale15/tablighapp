<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials.head')

<body class="min-h-screen font-sans antialiased bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="font-sans flex-1 flex flex-col min-h-screen ml-64">
            <!-- Top Bar -->
            <header class="bg-white shadow">
                <div class="w-full px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
                    <!-- Hamburger -->
                    <button class="md:hidden text-gray-600" onclick="toggleSidebar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-lg font-semibold"></h1>
                    <x-ui.profile-dropdown />
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/preline@3.0.0/index.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.7/dist/cdn.min.js"></script>
</body>

</html>

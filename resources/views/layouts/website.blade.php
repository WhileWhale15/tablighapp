<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials.head')

<body class="w-full min-h-screen font-sans antialiased bg-gray-100 flex flex-col">
    <div class="flex flex-col min-h-screen">
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Website Header -->
            <x-website-header />
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
        </div>
        <footer class="w-full bg-white border-t mt-8">
            <x-website-footer />
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/preline@3.0.0/index.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.7/dist/cdn.min.js"></script>
    @stack('scripts')
</body>

</html>

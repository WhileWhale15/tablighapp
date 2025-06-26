<x-admin-layout>

    <!-- Title and Breadcrumb -->
    <div class="bg-gray-100 py-4 space-y-2">
        <h1 class="py-3 text-5xl font-semibold text-gray-800">Beranda</h1>
        <nav class="text-sm font-medium text-gray-500 mt-1">
            <ol class="inline-flex space-x-1">
                <li>
                    <span class="text-gray-700">Beranda</span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="py-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Stats Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-[#191D23] rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Kecamatan</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ $kecamatanCount }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelurahan Stats -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-[#191D23] rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total
                                    Kelurahan</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ $kelurahanCount }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mesjid Stats -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-[#191D23] rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total
                                    Mesjid</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ $mesjidCount }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jemaah Stats -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-[#191D23] rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total
                                    Jemaah</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ $jemaahCount }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule and Calendar Section -->
        <div class="grid grid-cols-1 lg:grid-cols-8 gap-4 mt-8">
            <!-- Dakwah Schedule Table -->
            <div class="lg:col-span-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Dakwah</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul & Deskripsi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mesjid
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($dakwahSchedules as $schedule)
                                <tr>
                                    <!-- Tanggal Column -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($schedule->tanggal)->format('d M Y') }}
                                    </td>

                                    <!-- Judul & Deskripsi Column -->
                                    <td class="px-6 py-4 whitespace-wrap text-sm text-gray-900">
                                        <div>
                                            <span class="font-semibold">{{ $schedule->judul }}</span><br>
                                            <span class="text-gray-500">
                                                {{ \Illuminate\Support\Str::limit($schedule->deskripsi, 80, '...') }}
                                            </span>
                                        </div>
                                    </td>

                                    <!-- Mesjid Column -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if ($schedule->mesjid)
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($schedule->mesjid->alamat) }}"
                                                target="_blank" class="text-gray-900 hover:underline"
                                                title="Klik untuk membuka Google Maps">
                                                {{ $schedule->mesjid->nama_mesjid }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:col-span-2">
                <div class="max-w-sm w-full md:max-w-full sm:max-w-full shadow-lg">
                    <div class="md:p-6 p-5 bg-white rounded-t">
                        <div class="flex items-center justify-between">
                            <span id="calendar-month" tabindex="0"
                                class="focus:outline-none text-base font-bold text-gray-800">
                                {{ now()->format('F Y') }}
                            </span>
                            <div class="flex items-center">
                                <button id="calendar-backward" aria-label="calendar backward"
                                    class="focus:text-gray-400 hover:text-gray-400 text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-chevron-left-icon lucide-chevron-left">
                                        <path d="m15 18-6-6 6-6" />
                                    </svg>
                                </button>
                                <button id="calendar-forward" aria-label="calendar forward"
                                    class="focus:text-gray-400 hover:text-gray-400 ml-3 text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-6 overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="w-full flex justify-center">
                                                <p class="text-base font-medium text-center text-gray-800">Sen</p>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="w-full flex justify-center">
                                                <p class="text-base font-medium text-center text-gray-800">Sel</p>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="w-full flex justify-center">
                                                <p class="text-base font-medium text-center text-gray-800">Rab</p>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="w-full flex justify-center">
                                                <p class="text-base font-medium text-center text-gray-800">Kam</p>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="w-full flex justify-center">
                                                <p class="text-base font-medium text-center text-gray-800">Jum</p>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="w-full flex justify-center">
                                                <p class="text-base font-medium text-center text-gray-800">Sab</p>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="w-full flex justify-center">
                                                <p class="text-base font-medium text-center text-gray-800">Min</p>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="calendar-body">
                                    @foreach ($calendarDays as $week)
                                        <tr>
                                            @foreach ($week as $day)
                                                <td class="pt-1">
                                                    <div class="px-2 py-2 cursor-pointer flex w-full justify-center">
                                                        @if ($day)
                                                            @php
                                                                $event = $dakwahSchedules->firstWhere('tanggal', now()->startOfMonth()->addDays($day - 1)->toDateString());
                                                            @endphp
                                                            <p class="text-base text-gray-500 font-medium">
                                                                {{ $day }}
                                                                @if ($event)
                                                                    <span class="text-xs text-blue-500">•</span>
                                                                @endif
                                                            </p>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Integration -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarMonth = document.getElementById('calendar-month');
            const calendarBody = document.getElementById('calendar-body');
            const backwardButton = document.getElementById('calendar-backward');
            const forwardButton = document.getElementById('calendar-forward');

            let currentDate = new Date();
            const today = new Date(); // Get today's date

            function updateCalendar() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();

                // Update the month and year display
                calendarMonth.textContent = new Intl.DateTimeFormat('id-ID', { month: 'long', year: 'numeric' }).format(currentDate);

                // Generate calendar days
                const firstDayOfMonth = new Date(year, month, 1);
                const lastDayOfMonth = new Date(year, month + 1, 0);

                // Adjust the start of the week to Monday (Indonesian week starts on Monday)
                const startOfWeek = new Date(firstDayOfMonth);
                startOfWeek.setDate(firstDayOfMonth.getDate() - ((firstDayOfMonth.getDay() + 6) % 7));

                const endOfWeek = new Date(lastDayOfMonth);
                endOfWeek.setDate(lastDayOfMonth.getDate() + (7 - lastDayOfMonth.getDay()) % 7);

                let html = '';
                let current = new Date(startOfWeek);

                while (current <= endOfWeek) {
                    html += '<tr>';
                    for (let i = 0; i < 7; i++) {
                        const isToday =
                            current.getDate() === today.getDate() &&
                            current.getMonth() === today.getMonth() &&
                            current.getFullYear() === today.getFullYear();

                        if (current.getMonth() === month) {
                            html += `<td class="pt-1">
                                        <div class="p-1.5 cursor-pointer flex w-full justify-center ${isToday ? 'bg-[#191D23] rounded-full' : ''
                                }">
                                            <p class="text-base text-gray-500 font-medium ${isToday ? 'text-white font-bold' : ''
                                }">${current.getDate()}</p>
                                        </div>
                                    </td>`;
                        } else {
                            html += `<td class="pt-1">
                                        <div class="p-1.5 cursor-pointer flex w-full justify-center text-gray-300">
                                            <p class="text-base">${current.getDate()}</p>
                                        </div>
                                    </td>`;
                        }
                        current.setDate(current.getDate() + 1);
                    }
                    html += '</tr>';
                }

                calendarBody.innerHTML = html;
            }

            // Event listeners for navigation buttons
            backwardButton.addEventListener('click', function () {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateCalendar();
            });

            forwardButton.addEventListener('click', function () {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateCalendar();
            });

            // Initialize the calendar
            updateCalendar();
        });
    </script>
</x-admin-layout>

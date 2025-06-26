<x-website-layout>

    <!-- Breadcrumb -->
    <div class="max-w-full mx-auto py-6 px-6 md:px-16 lg:px-16">
        <x-web.breadcrumb :items="[
        ['label' => 'Beranda', 'url' => route('user.home')],
    ]" />

        <!-- Content -->
        <div class="w-full py-6">
            <!-- Search Bar & Date Filter -->
            <div
                class="relative w-full max-w-2xl mx-auto bg-white rounded-lg shadow-md p-1.5 transition-all duration-150 ease-in-out hover:shadow-lg mb-6 z-0 flex items-center">
                <form method="GET" class="flex items-center flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari kegiatan, masjid, atau deskripsi..."
                        class="w-full pl-10 pr-36 py-3 text-base text-gray-700 bg-transparent border-0 rounded-lg focus:outline-none placeholder-gray-400" />

                    <!-- Calendar Button (not constrained by div) -->
                    <div class="flex items-center gap-0.5">
                        <div class="mr-2 relative flex items-center" id="calendarTriggerWrapper">
                            <input id="datePicker" name="date" type="text" value="{{ request('date') }}"
                                class="w-0 h-0 opacity-0 absolute">
                            <button type="button" id="calendarBtn"
                                onclick="document.getElementById('datePicker')._flatpickr.open()"
                                class="px-3 py-2 border border-[#24937E] rounded-lg bg-white inline-flex items-center justify-center transition-all">
                                <span id="calendarIcon" class="flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span id="selectedDateText"
                                    class="hidden text-[#24937E] font-semibold text-base select-none whitespace-nowrap">
                                    <!-- Date will be injected here -->
                                </span>
                            </button>
                        </div>

                        <!-- Cari Button -->
                        <button
                            class="px-2.5 py-2.5 bg-[#24937E] text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#24937E] hover:bg-[#0E5D4E] transition duration-150 ease-in-out md:px-8 lg:px-8"
                            type="submit">
                            <p class="hidden md:block lg:block">Cari</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="block md:hidden lg:hidden lucide lucide-search-icon lucide-search">
                                <path d="m21 21-4.34-4.34" />
                                <circle cx="11" cy="11" r="8" />
                            </svg>
                        </button>

                        @if(request('q') || request('date'))
                            <button type="button" onclick="resetSearch(event)"
                                class="ml-2 px-2.5 py-2.5 border border-[#24937E] text-[#24937E] font-medium rounded-lg bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#24937E] transition duration-150 ease-in-out md:px-6 lg:px-6">
                                <p class="hidden md:block lg:block">Reset</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="block md:hidden lg:hidden lucide lucide-x-icon lucide-x">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            <div class="flex flex-col md:flex-row gap-2" style="min-height:500px;">
                <!-- Map Section -->
                <div
                    class="m-2 md:w-2/3 w-full h-[500px] mb-6 md:mb-0 rounded-lg ring-2 ring-[#24937E] overflow-hidden bg-white z-0">
                    @php
                        $selected = request('selected') ? $kegiatan->firstWhere('id', request('selected')) : $kegiatan->first();
                    @endphp
                    @if($selected && $selected->mesjid && $selected->mesjid->alamat)
                        <iframe width="100%" height="100%" frameborder="0" style="border:0; min-height:500px; z-index:0;"
                            src="https://www.google.com/maps?q={{ urlencode($selected->mesjid->alamat) }}&output=embed"
                            allowfullscreen class="rounded-xl w-full h-full z-0"></iframe>
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 rounded-lg text-gray-500">
                            Lokasi tidak tersedia
                        </div>
                    @endif
                </div>

                <!-- Event List Section -->
                <div class="md:w-1/3 w-full max-h-[500px] overflow-y-auto p-2 flex flex-col gap-4">
                    @forelse($kegiatan as $item)
                        <div
                            class="border rounded-lg p-4 flex gap-4 items-center bg-white shadow transition-all duration-150 min-h-[120px] max-h-[160px] group @if(request('selected', $kegiatan->first()->id) == $item->id) ring-2 ring-[#24937E] @endif">
                            <div class="flex-shrink-0 flex items-center h-full">
                                <img src="{{ $item->mesjid->image_url ?? '/images/default-mosque.jpg' }}" alt=""
                                    class="w-20 h-full rounded object-cover" />
                            </div>
                            <div class="flex-1 min-w-0 overflow-hidden">
                                <div class="flex items-center gap-2 mb-1">
                                    <span
                                        class="text-xs text-gray-500 font-semibold">{{ strtoupper($item->tanggal->format('M')) }}</span>
                                    <span class="text-2xl font-bold text-gray-800">{{ $item->tanggal->format('d') }}</span>
                                    <span class="text-xs text-gray-500">{{ $item->tanggal->format('Y') }}</span>
                                </div>
                                <div class="font-semibold text-lg text-gray-900 line-clamp-1">{{ $item->judul }}
                                </div>
                                <div class="text-gray-600 text-sm mb-1 line-clamp-2">
                                    {{ $item->mesjid->nama_mesjid ?? '-' }},
                                    {{ $item->mesjid->alamat ?? '-' }}
                                </div>
                                <div class="text-gray-500 text-xs">
                                    {{ $item->tanggal->format('g:i a') }} -
                                    {{ $item->tanggal->addHours(2)->format('g:i a') }}
                                </div>
                                <div class="flex gap-3 mt-2">
                                    <a href="{{ route('user.kegiatan.detail', $item->id) }}"
                                        class="text-[#0E5D4E] hover:underline text-sm font-medium">Detail Kegiatan</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500 text-center">Tidak ada kegiatan dakwah ditemukan.</div>
                    @endforelse
                    <div class="mt-8 flex justify-center">
                        {{ $kegiatan->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS STYLING -->
    <style>
        .group:not(.ring-2):hover {
            box-shadow: 0 0 0 2px #93c5fd !important;
            border-color: #24937E !important;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
        }
    </style>

    <!-- Flatpickr Indonesian locale -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const icon = document.getElementById('calendarIcon');
            const dateText = document.getElementById('selectedDateText');
            function setDateButton(date) {
                if (date) {
                    dateText.textContent = date;
                    dateText.classList.remove('hidden');
                    icon.classList.add('hidden');
                } else {
                    dateText.textContent = '';
                    dateText.classList.add('hidden');
                    icon.classList.remove('hidden');
                }
            }
            // On page load, show date if present
            @if(request('date'))
                setDateButton(@json(\Carbon\Carbon::parse(request('date'))->translatedFormat('d F Y')));
            @else
                setDateButton(null);
            @endif
            flatpickr("#datePicker", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                allowInput: true,
                defaultDate: "{{ request('date') }}",
                appendTo: document.body, // required if positioning fails
                positionElement: document.getElementById('calendarTriggerWrapper'),
                position: "below left",
                locale: 'id',
                onOpen: function (selectedDates, dateStr, instance) {
                    instance.calendarContainer.style.marginTop = '8px';
                },
                onChange: function (selectedDates, dateStr, instance) {
                    if (selectedDates.length > 0) {
                        // Use Flatpickr's formatDate with Indonesian locale
                        const formatted = instance.formatDate(selectedDates[0], "d F Y");
                        setDateButton(formatted);
                    } else {
                        setDateButton(null);
                    }
                }
            });
        });

        function resetSearch(event) {
            if (event) event.preventDefault();
            // Instantly reload page with no query params
            window.location.href = window.location.pathname;
        }
    </script>


</x-website-layout>

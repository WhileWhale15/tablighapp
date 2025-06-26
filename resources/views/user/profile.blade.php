<x-website-layout>

    <!-- Breadcrumb -->
    <div class="container max-w-6xl mx-auto px-4 py-12 mb-6">
        <!-- Title and Breadcrumb -->
        <div class="">
            <h1 class="py-3 text-5xl font-semibold text-gray-800">Pengaturan Profil</h1>
            <nav class="text-sm font-medium text-gray-500 mt-1">
                <ol class="inline-flex space-x-1">
                    <li>
                        <a href="{{ route('user.home') }}" class="hover:text-gray-700">Beranda</a>
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

        <!-- Content -->
        <div class="py-8">
            <div class="space-y-6">
                <!-- User Profile Info -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Jamaah Profile Info (merged from profile-settings.blade.php) -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Informasi Data Jemaah') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Perbarui informasi profil dan alamat email akun Anda.') }}
                        </p>

                        @if(session('success'))
                            <div class="mb-4 text-green-600">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('user.profile.settings.update') }}"
                            class=" mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="nama" :value="__('Nama')" />
                                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                    :value="old('nama', $jemaah->nama)" required autofocus autocomplete="nama" />
                                <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                            </div>
                            <div>
                                <x-input-label for="no_telepon" :value="__('No. Telepon')" />
                                <x-text-input id="no_telepon" name="no_telepon" type="text" class="mt-1 block w-full"
                                    :value="old('no_telepon', $jemaah->no_telepon)" autocomplete="no_telepon" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_telepon')" />
                            </div>
                            <div>
                                <x-input-label for="no_ktp" :value="__('Nomor KTP')" />
                                <x-text-input id="no_ktp" name="no_ktp" type="text" class="mt-1 block w-full"
                                    :value="old('no_ktp', $jemaah->no_ktp)" autocomplete="no_ktp" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_ktp')" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="px-3 py-2.5 border-gray-300 focus:border-[#24937E] focus:ring-[#24937E] rounded-md shadow-sm w-full">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki" @selected($jemaah->jenis_kelamin == 'Laki-laki')>Laki-laki
                                    </option>
                                    <option value="Perempuan" @selected($jemaah->jenis_kelamin == 'Perempuan')>Perempuan
                                    </option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                            </div>
                            <div>
                                <x-input-label for="alamat" :value="__('Alamat')" />
                                <textarea id="alamat" name="alamat"
                                    class="px-3 py-2.5 border-gray-300 focus:border-[#24937E] focus:ring-[#24937E] rounded-md shadow-sm w-full">{{ old('alamat', $jemaah->alamat) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                            </div>
                            <div>
                                <x-input-label for="mesjid_id" :value="__('Afiliasi Mesjid')" />
                                <div class="relative" style="z-index:50;">
                                    <input id="mesjid_id_autocomplete" type="text"
                                        class="px-3 py-2.5 border-gray-300 focus:border-[#24937E] focus:ring-[#24937E] rounded-md shadow-sm w-full"
                                        placeholder="Cari nama mesjid, kelurahan, atau kecamatan..." autocomplete="off"
                                        value="{{ old('mesjid_id', $jemaah->mesjid_id ? ($jemaah->mesjid->nama_mesjid . ' • ' . optional($jemaah->mesjid->kelurahan)->nama_kelurahan . ', ' . optional(optional($jemaah->mesjid->kelurahan)->kecamatan)->nama_kecamatan) : '') }}">
                                    <input type="hidden" id="mesjid_id" name="mesjid_id"
                                        value="{{ old('mesjid_id', $jemaah->mesjid_id) }}">
                                    <div id="mesjid-autocomplete-list"
                                        class="absolute z-50 bg-white border border-gray-300 w-full mt-1 rounded-md shadow-lg min-h-[2rem] pointer-events-auto hidden"
                                        style="max-height: 16rem; overflow-y: auto;">
                                    </div>
                                    <div id="autocomplete-debug" class="text-xs text-red-500 mt-1"></div>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('mesjid_id')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Simpan') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition
                                        x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                        {{ __('Tersimpan.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Update -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const debugDiv = document.getElementById('autocomplete-debug');
                const input = document.getElementById('mesjid_id_autocomplete');
                const hiddenInput = document.getElementById('mesjid_id');
                const list = document.getElementById('mesjid-autocomplete-list');
                let lastAjaxController = null;
                const ajaxUrl = "{{ url('/ajax/mesjid-search') }}";

                function showDropdown(matches) {
                    console.log('showDropdown called', matches);
                    list.innerHTML = '';
                    if (!Array.isArray(matches)) {
                        if (debugDiv) debugDiv.textContent = 'Autocomplete error: response is not an array';
                        return;
                    }
                    matches.forEach(m => {
                        const option = document.createElement('div');
                        option.className = 'px-4 py-2 cursor-pointer hover:bg-gray-100 flex items-center gap-1';
                        option.innerHTML = `<span class='font-semibold'>${m.nama_mesjid} </span> <span class='text-sm text-gray-600'> • ${m.kelurahan}, ${m.kecamatan}</span>`;
                        option.onclick = function () {
                            input.value = `${m.nama_mesjid} • ${m.kelurahan}, ${m.kecamatan}`;
                            hiddenInput.value = m.id;
                            list.classList.add('hidden');
                        };
                        list.appendChild(option);
                    });
                    list.classList.toggle('hidden', matches.length === 0);
                }

                if (!input) {
                    if (debugDiv) debugDiv.textContent = 'Autocomplete input not found!';
                } else {
                    input.addEventListener('input', function () {
                        const val = this.value;
                        console.log('input event fired', val);
                        if (lastAjaxController) lastAjaxController.abort();
                        lastAjaxController = new AbortController();
                        const url = ajaxUrl + '?q=' + encodeURIComponent(val);
                        fetch(url, {
                            signal: lastAjaxController.signal
                        })
                            .then(r => r.json())
                            .then(data => {
                                console.log('AJAX response', data);
                                showDropdown(data);
                            })
                            .catch(e => {
                                if (e.name !== 'AbortError') showDropdown([]);
                            });
                    });
                    input.addEventListener('focus', function () {
                        const val = this.value;
                        console.log('focus event fired', val);
                        if (lastAjaxController) lastAjaxController.abort();
                        lastAjaxController = new AbortController();
                        const url = ajaxUrl + '?q=' + encodeURIComponent(val);
                        fetch(url, {
                            signal: lastAjaxController.signal
                        })
                            .then(r => r.json())
                            .then(data => {
                                console.log('AJAX response (focus)', data);
                                showDropdown(data);
                            })
                            .catch(e => {
                                if (e.name !== 'AbortError') showDropdown([]);
                            });
                    });
                    document.addEventListener('click', function (e) {
                        if (!input.contains(e.target) && !list.contains(e.target)) {
                            list.classList.add('hidden');
                        }
                    });
                }
            });
        </script>
    @endpush

</x-website-layout>

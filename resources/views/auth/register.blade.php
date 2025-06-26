<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center my-6">
        <h2 class="text-3xl font-semibold text-gray-900 text-center tracking-wide">Daftar</h2>
    </div>


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Mesjid Affiliation -->
        <div class="mt-4 relative">
            <x-input-label for="mesjid_affiliation" :value="__('Afiliasi Mesjid')" />
            <x-text-input id="mesjid_affiliation" name="mesjid_affiliation" type="text" class="block mt-1 w-full"
                autocomplete="off" placeholder="Cari dan pilih mesjid..." required />
            <input type="hidden" id="mesjid_id" name="mesjid_id" />
            <div id="mesjid-suggestions"
                class="absolute z-10 w-full bg-white border border-gray-200 rounded shadow-md hidden"></div>
            <x-input-error :messages="$errors->get('mesjid_id')" class="mt-2" />
        </div>

        <div class="w-full flex items-center justify-center my-6">
            <x-primary-button class="w-full">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mb-2 text-center text-sm text-gray-600">
        Sudah punya akun?
        <a class="text-[#24937E] hover:text-[#0E5D4E] font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0E5D4E]"
            href="{{ route('login') }}">
            {{ __('Masuk') }}
        </a>
    </div>

    <!-- SCRIPTS JS -->
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('mesjid_affiliation');
                const hiddenId = document.getElementById('mesjid_id');
                const suggestions = document.getElementById('mesjid-suggestions');

                input.addEventListener('input', function () {
                    let query = this.value;
                    hiddenId.value = '';
                    if (query.length < 2) {
                        suggestions.innerHTML = '';
                        suggestions.classList.add('hidden');
                        return;
                    }
                    fetch('/mesjid-search?q=' + encodeURIComponent(query))
                        .then(res => res.json())
                        .then(data => {
                            suggestions.innerHTML = '';
                            if (data.length === 0) {
                                suggestions.classList.add('hidden');
                                return;
                            }
                            data.forEach(function (item) {
                                let div = document.createElement('div');
                                div.innerHTML = `<span class='font-bold'>${item.nama_mesjid}</span> &bull; ${item.kelurahan}, ${item.kecamatan}`;
                                div.className = 'suggestion-item px-4 py-2 cursor-pointer hover:bg-[#e6f4f1]';
                                div.onclick = function () {
                                    input.value = `${item.nama_mesjid} • ${item.kelurahan}, ${item.kecamatan}`;
                                    hiddenId.value = item.id;
                                    suggestions.innerHTML = '';
                                    suggestions.classList.add('hidden');
                                };
                                suggestions.appendChild(div);
                            });
                            suggestions.classList.remove('hidden');
                        });
                });
                // Hide suggestions on blur
                input.addEventListener('blur', function () {
                    setTimeout(() => suggestions.classList.add('hidden'), 200);
                });
            });
        </script>
    @endpush
</x-guest-layout>

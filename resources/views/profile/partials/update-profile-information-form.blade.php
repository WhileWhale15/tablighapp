<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Perbarui informasi profil dan alamat email akun Anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin-profile.update') }}" enctype="multipart/form-data"
        class="mt-6 space-y-6">

        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_picture" :value="__('Foto Profil')" />
            <div class="flex items-center mt-2 space-x-4">
                <div>
                    @if ($user->profile_picture)
                        <img id="profile-picture-preview" src="{{ asset('storage/' . $user->profile_picture) }}"
                            alt="Profile Picture"
                            class="h-16 w-16 shadow-sm border border-gray-300 rounded-full object-cover" />
                    @else
                        <svg id="profile-picture-preview"
                            class="h-16 w-16 shadow-sm border border-gray-300 rounded-full text-gray-400"
                            fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                            <path d="M12 14c-4 0-6 2-6 4v2h12v-2c0-2-2-4-6-4z" />
                        </svg>
                    @endif
                </div>
                <div>
                    <label for="profile_picture"
                        class="cursor-pointer inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Ganti Foto Profil
                    </label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden"
                        onchange="previewProfilePicture(event)" />
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Username')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>

    <script>
        function previewProfilePicture(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('profile-picture-preview');
                    if (preview.tagName.toLowerCase() === 'img') {
                        preview.src = e.target.result;
                    } else {
                        // Replace SVG with img element
                        const img = document.createElement('img');
                        img.id = 'profile-picture-preview';
                        img.src = e.target.result;
                        img.alt = 'Profile Picture';
                        img.className = 'h-12 w-12 rounded-full object-cover';
                        preview.parentNode.replaceChild(img, preview);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</section>

<div class="flex items-center gap-4">
    <span class="text-base font-semibold text-gray-900">Daftar</span>
<label class="relative inline-flex cursor-pointer items-center">
    <input type="checkbox" id="page-switcher" value="" class="peer sr-only" />
    <div
        class="peer flex h-10 w-48 items-center gap-6 rounded-full bg-[#0E7E6B] px-4 relative after:absolute after:left-1 after:h-8 after:w-20 after:rounded-full after:bg-white/90 after:shadow-md after:transition-all after:content-[''] peer-checked:bg-[#0E7E6B] peer-checked:after:translate-x-full peer-focus:outline-none text-base font-semibold text-black"
    >
        <span class="z-10 relative"> </span>
        <span class="z-10 relative"> </span>
    </div>
</label>
    <span class="text-base font-semibold text-gray-900">Masuk</span>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const switcher = document.getElementById('page-switcher');
        if (!switcher) return;

        // Set initial state based on current URL
        if (window.location.pathname === '{{ route("login") }}') {
            switcher.checked = true;
        } else {
            switcher.checked = false;
        }

        switcher.addEventListener('change', function () {
            if (this.checked) {
                window.location.href = '{{ route("login") }}';
            } else {
                window.location.href = '{{ route("register") }}';
            }
        });
    });
</script>

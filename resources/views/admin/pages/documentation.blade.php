<x-admin-layout>

    <!-- Title and Breadcrumb -->
    <div class="bg-gray-100 py-4 space-y-2">
        <h1 class="py-3 text-5xl font-semibold text-gray-800">Dokumentasi Admin Panel</h1>
        <x-breadcrumb :breadcrumbs="[
        ['name' => 'Dokumentasi', 'url' => route('admin.documentation')],
    ]" />
    </div>

    <!-- Main Content -->
    <div class="py-8">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Sidebar Navigasi -->
            <nav class="md:w-fit mb-6 md:mb-0">
                <div class="w-[300px] bg-white rounded-lg shadow p-8 pr-12 sticky top-24">
                    <h2 class="text-lg font-semibold mb-3">Daftar Isi</h2>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="#overview" class="text-[#24937E] hover:underline">1. Overview & Alur Navigasi</a>
                        </li>
                        <li>
                            <a href="#dashboard" class="text-[#24937E] hover:underline">2. Dashboard</a>
                        </li>
                        <li>
                            <a href="#kelurahan" class="text-[#24937E] hover:underline">3. Kelurahan</a>
                        </li>
                        <li>
                            <a href="#mesjid" class="text-[#24937E] hover:underline">4. Mesjid</a>
                        </li>
                        <li>
                            <a href="#jemaah" class="text-[#24937E] hover:underline">5. Jemaah</a>
                        </li>
                        <li>
                            <a href="#user" class="text-[#24937E] hover:underline">6. User & Hak Akses</a>
                        </li>
                        <li>
                            <a href="#fitur-lain" class="text-[#24937E] hover:underline">7. Fitur Lain</a>
                        </li>
                        <li>
                            <a href="#faq" class="text-[#24937E] hover:underline">8. FAQ & Bantuan</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Konten Dokumentasi -->
            <div class="md:w-full space-y-10">
                <div class="bg-white rounded-lg p-8 flex-col">
                    <section id="overview">
                        <h2 class="text-2xl font-semibold mb-2">Overview & Alur Navigasi</h2>
                        <p class="mb-2">Admin panel aplikasi ini digunakan untuk mengelola data komunitas mesjid,
                            kelurahan,
                            jemaah, dan pengguna. Setiap menu di sidebar mewakili fitur utama yang dapat diakses oleh
                            admin.
                        </p>
                        <ul class="list-disc ml-6 text-sm text-gray-700 mb-4">
                            <li>Dashboard: Ringkasan data dan statistik.</li>
                            <li>Kelurahan: Manajemen data kelurahan.</li>
                            <li>Mesjid: Manajemen data mesjid per kelurahan.</li>
                            <li>Jemaah: Manajemen data jemaah per mesjid.</li>
                            <li>User: Manajemen akun pengguna/admin.</li>
                        </ul>
                        <div class="my-4">
                            <p class="text-sm text-gray-600 mb-1">Diagram alur navigasi utama:</p>
                            <!-- Ganti overview-flow.png dengan diagram navigasi aplikasi Anda -->
                            <img src="/documentation/overview-flow.png" alt="Diagram Alur Navigasi"
                                class="rounded-lg shadow border mb-2">
                        </div>
                    </section>
                    <section id="dashboard" class="pt-6">
                        <h2 class="text-2xl font-semibold mb-2">Dashboard</h2>
                        <p>Menampilkan statistik ringkas: jumlah kelurahan, mesjid, jemaah, dan aktivitas terakhir.
                            Navigasi
                            ke menu lain dapat dilakukan dari sidebar.</p>
                        <div class="my-4">
                            <p class="text-sm text-gray-600 mb-1">Contoh tampilan dashboard:</p>
                            <img src="/documentation/dashboard-example.png" alt="Contoh Dashboard"
                                class="rounded-lg shadow border mb-2">
                        </div>
                    </section>
                    <section id="kelurahan" class="pt-6">
                        <h2 class="text-2xl font-semibold mb-2">Kelurahan</h2>
                        <ul class="list-decimal ml-6 text-sm text-gray-700 mb-4">
                            <li>Lihat daftar kelurahan, jumlah mesjid, dan tanggal dibuat.</li>
                            <li>Tambah kelurahan baru dengan tombol <span class="font-semibold">Tambah Data</span>.</li>
                            <li>Edit/hapus kelurahan dengan tombol aksi di kolom kanan.</li>
                            <li>Klik nama kelurahan untuk melihat daftar mesjid di kelurahan tersebut.</li>
                        </ul>
                        <div class="my-4">
                            <p class="text-sm text-gray-600 mb-1">Contoh tabel kelurahan:</p>
                            <img src="/documentation/kelurahan-table.png" alt="Tabel Kelurahan"
                                class="rounded-lg shadow border mb-2">
                        </div>
                    </section>
                    <section id="mesjid" class="pt-6">
                        <h2 class="text-2xl font-semibold mb-2">Mesjid</h2>
                        <ul class="list-decimal ml-6 text-sm text-gray-700 mb-4">
                            <li>Lihat daftar mesjid per kelurahan, jumlah jemaah, alamat, dan tanggal dibuat.</li>
                            <li>Tambah mesjid baru, edit, atau hapus data mesjid.</li>
                            <li>Klik tombol <span class="font-semibold">Lihat</span> untuk melihat daftar jemaah di
                                mesjid
                                tersebut.</li>
                        </ul>
                        <div class="my-4" class="py-2">
                            <p class="text-sm text-gray-600 mb-1">Contoh tabel mesjid:</p>
                            <img src="/documentation/mesjid-table.png" alt="Tabel Mesjid"
                                class="rounded-lg shadow border mb-2">
                        </div>
                    </section>
                    <section id="jemaah" class="pt-6">
                        <h2 class="text-2xl font-semibold mb-2">Jemaah</h2>
                        <ul class="list-decimal ml-6 text-sm text-gray-700 mb-4">
                            <li>Lihat daftar jemaah per mesjid, detail profil, dan pengalaman khuruj.</li>
                            <li>Tambah, edit, atau hapus data jemaah.</li>
                            <li>Gunakan fitur pencarian dan filter untuk memudahkan pengelolaan data.</li>
                        </ul>
                        <div class="my-4">
                            <p class="text-sm text-gray-600 mb-1">Contoh tabel jemaah:</p>
                            <img src="/documentation/jemaah-table.png" alt="Tabel Jemaah"
                                class="rounded-lg shadow border mb-2">
                        </div>
                    </section>
                    <section id="user" class="pt-6">
                        <h2 class="text-2xl font-semibold mb-2">User & Hak Akses</h2>
                        <ul class="list-decimal ml-6 text-sm text-gray-700 mb-4">
                            <li>Lihat daftar user/admin, role, dan status.</li>
                            <li>Tambah user baru, edit, atau hapus user.</li>
                            <li>Atur role dan hak akses user sesuai kebutuhan.</li>
                        </ul>
                        <div class="my-4">
                            <p class="text-sm text-gray-600 mb-1">Tabel role & hak akses:</p>
                            <img src="/documentation/role-table.png" alt="Tabel Role & Hak Akses"
                                class="rounded-lg shadow border mb-2">
                        </div>
                    </section>
                    <section id="fitur-lain" class="pt-6">
                        <h2 class="text-2xl font-semibold mb-2">Fitur Lain</h2>
                        <ul class="list-disc ml-6 text-sm text-gray-700 mb-4">
                            <li>Pencarian dan filter data di setiap tabel. <br><span class="text-xs">(Contoh UI:
                                    <code>/documentation/filter-ui.png</code>)</span></li>
                            <li>Export data (jika tersedia). <br><span class="text-xs">(Contoh UI:
                                    <code>/documentation/export-ui.png</code>)</span></li>
                            <li>Notifikasi dan konfirmasi aksi penting. <br><span class="text-xs">(Contoh UI:
                                    <code>/documentation/notification-ui.png</code>)</span></li>
                            <li>Breadcrumb navigasi di setiap halaman.</li>
                        </ul>
                        <div class="my-4" class="py-2">
                            <img src="/documentation/filter-ui.png" alt="Contoh Filter UI"
                                class="rounded-lg shadow border mb-2">
                            <img src="/documentation/export-ui.png" alt="Contoh Export UI"
                                class="rounded-lg shadow border mb-2">
                            <img src="/documentation/notification-ui.png" alt="Contoh Notifikasi UI"
                                class="rounded-lg shadow border mb-2">
                            <p class="text-xs text-gray-500">Letakkan gambar UI fitur di
                                <code>public/documentation/</code>
                                sesuai nama file di atas.
                            </p>
                        </div>
                    </section>
                    <section id="faq" class="pt-6">
                        <h2 class="text-2xl font-semibold mb-2">FAQ & Bantuan</h2>
                        <ul class="list-disc ml-6 text-sm text-gray-700 mb-4">
                            <li><span class="font-semibold">Bagaimana menambah data?</span> Klik tombol <span
                                    class="font-semibold">Tambah Data</span> di setiap halaman.</li>
                            <li><span class="font-semibold">Bagaimana mengedit/hapus data?</span> Gunakan tombol aksi di
                                kolom kanan tabel.</li>
                            <li><span class="font-semibold">Siapa yang bisa mengakses admin panel?</span> Hanya user
                                dengan
                                role admin.</li>
                            <li><span class="font-semibold">Butuh bantuan lebih lanjut?</span> Hubungi admin utama atau
                                support IT.</li>
                        </ul>
                        <div class="my-4">
                            <p class="text-sm text-gray-600 mb-1">Contoh kontak bantuan:</p>
                            <img src="/documentation/contact-support.png" alt="Kontak Bantuan"
                                class="rounded-lg shadow border mb-2">
                            <p class="text-xs text-gray-500">Letakkan gambar kontak di
                                <code>public/documentation/contact-support.png</code>
                            </p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

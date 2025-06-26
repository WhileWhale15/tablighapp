@extends('layouts.website')

@section('title', $jamaah->nama)

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $jamaah->nama }}</h1>
            <div class="mb-2 text-gray-700">Alamat: <span class="font-medium">{{ $jamaah->alamat }}</span></div>
            <div class="mb-2 text-gray-700">Masjid: <span
                    class="font-medium">{{ $jamaah->mesjid->nama_mesjid ?? '-' }}</span></div>
            <div class="mb-2 text-gray-700">Kelurahan: <span
                    class="font-medium">{{ $jamaah->mesjid->kelurahan->nama_kelurahan ?? '-' }}</span></div>
            <div class="mb-2 text-gray-700">Kecamatan: <span
                    class="font-medium">{{ $jamaah->mesjid->kelurahan->kecamatan->nama_kecamatan ?? '-' }}</span></div>
            <a href="{{ url()->previous() }}" class="inline-block mt-6 text-blue-600 hover:underline">&larr; Kembali ke
                daftar</a>
        </div>
    </div>
@endsection
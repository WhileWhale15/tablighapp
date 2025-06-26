@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Direktori Masjid</h1>
        <ul class="divide-y divide-gray-200">
            @foreach($masjid as $item)
                <li class="py-4">
                    <div class="font-semibold text-lg">{{ $item->nama_mesjid }}</div>
                    <div class="text-gray-500 text-sm">Kelurahan: {{ $item->kelurahan->nama_kelurahan ?? '-' }}, Kecamatan:
                        {{ $item->kelurahan->kecamatan->nama_kecamatan ?? '-' }}
                    </div>
                </li>
            @endforeach
        </ul>
        @if($masjid->isEmpty())
            <div class="text-gray-500">Belum ada data masjid.</div>
        @endif
    </div>
@endsection

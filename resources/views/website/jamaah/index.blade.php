@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Direktori Jamaah</h1>
        <ul class="divide-y divide-gray-200">
            @foreach($jamaah as $item)
                <li class="py-4">
                    <div class="font-semibold text-lg">{{ $item->nama_jamaah }}</div>
                    <div class="text-gray-500 text-sm">Masjid: {{ $item->mesjid->nama_mesjid ?? '-' }}, Kelurahan:
                        {{ $item->mesjid->kelurahan->nama_kelurahan ?? '-' }}, Kecamatan:
                        {{ $item->mesjid->kelurahan->kecamatan->nama_kecamatan ?? '-' }}</div>
                </li>
            @endforeach
        </ul>
        @if($jamaah->isEmpty())
            <div class="text-gray-500">Belum ada data jamaah.</div>
        @endif
    </div>
@endsection

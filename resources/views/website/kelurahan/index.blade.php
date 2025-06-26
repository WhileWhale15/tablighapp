@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Direktori Kelurahan</h1>
        <ul class="divide-y divide-gray-200">
            @foreach($kelurahan as $item)
                <li class="py-4">
                    <div class="font-semibold text-lg">{{ $item->nama_kelurahan }}</div>
                    <div class="text-gray-500 text-sm">Kecamatan: {{ $item->kecamatan->nama_kecamatan ?? '-' }}</div>
                </li>
            @endforeach
        </ul>
        @if($kelurahan->isEmpty())
            <div class="text-gray-500">Belum ada data kelurahan.</div>
        @endif
    </div>
@endsection

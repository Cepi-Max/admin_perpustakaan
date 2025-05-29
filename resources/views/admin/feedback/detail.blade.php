@extends('admin.layouts.app')


@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Detail Kritik & Saran</h1>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">
        <div>
            <span class="block text-gray-600 text-sm">Nama:</span>
            <span class="text-gray-900 font-semibold">{{ $item->nama }}</span>
        </div>
        <div>
            <span class="block text-gray-600 text-sm">Email:</span>
            <span class="text-gray-900">{{ $item->email ?? '-' }}</span>
        </div>
        <div>
            <span class="block text-gray-600 text-sm">No HP:</span>
            <span class="text-gray-900">{{ $item->no_hp ?? '-' }}</span>
        </div>
        <div>
            <span class="block text-gray-600 text-sm">Tanggal:</span>
            <span class="text-gray-900">{{ $item->created_at->format('d M Y - H:i') }}</span>
        </div>
        <div>
            <span class="block text-gray-600 text-sm">Kritik:</span>
            <p class="text-gray-900">{{ $item->kritik ?? '-' }}</p>
        </div>
        <div>
            <span class="block text-gray-600 text-sm">Saran:</span>
            <p class="text-gray-900">{{ $item->saran ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.feedback.show') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded">
            < Kembali
        </a>
    </div>
</div>

@endsection

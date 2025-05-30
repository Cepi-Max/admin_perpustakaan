@extends('pengunjung.layouts.app')
@section('title', $title)

@section('content')
<div class="container mx-auto px-4 py-6">

    <!-- Daftar Berita -->
    <h2 class="text-2xl font-bold mb-4">Berita Terbaru</h2>
    <div class="grid md:grid-cols-2 gap-6">
        @foreach ($berita as $item)
        <div class="bg-white rounded shadow p-4">
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover mb-3 rounded">
            @endif
            <h3 class="text-xl font-semibold mb-1">{{ $item->title }}</h3>
            <p class="text-sm text-gray-600 mb-2">Oleh: {{ $item->author->name }} | Kategori: {{ $item->kategori_berita->nama }}</p>
            <p class="text-gray-700">{{ Str::limit(strip_tags($item->body), 120) }}</p>
            <div class="mt-3 flex justify-between items-center text-sm text-gray-500">
                <span>Inovator: {{ $item->inovator }}</span>
                <span>{{ $item->seen }} dilihat</span>
            </div>
            <a href="{{ route('berita.show', $item->slug) }}" class="inline-block mt-3 text-blue-600 hover:underline">Baca Selengkapnya</a>
        </div>
        @endforeach
    </div>

    <!-- Paginasi -->
    <div class="mt-6">
        {{ $berita->links() }}
    </div>

    <!-- Daftar Iklan -->
    <h2 class="text-2xl font-bold mt-10 mb-4">Iklan</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($iklan as $ad)
        <div class="bg-gray-100 rounded p-4 shadow">
            @if($ad->gambar)
                <img src="{{ asset('storage/' . $ad->gambar) }}" alt="Iklan" class="w-full h-40 object-cover mb-2 rounded">
            @endif
            <p class="text-gray-700">{{ $ad->deskripsi }}</p>
        </div>
        @endforeach
    </div>

</div>
@endsection

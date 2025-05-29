@extends('admin.layouts.app')

@section('breadcrumb', 'Berita')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Berita Perpustakaan</h1>
                <p class="text-gray-600 mt-1">Kelola berita perpustakaan</p>
            </div>
            <a href="{{ route('admin.berita.form') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                <i class="bi bi-plus-lg mr-2"></i>
                Tambah Berita
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
            <form method="GET" action="{{ route('admin.berita.show') }}" class="mb-4">
                <div class="flex items-end gap-2">
                    <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                        class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
    

    <div class="overflow-x-auto mt-6 shadow-lg">
        <table class="min-w-full bg-white rounded">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Judul</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Admin</th>
                    <th class="px-4 py-3 text-center">Dilihat</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse ($berita as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $item->title }}</td>
                        <td class="px-4 py-3">{{ $item->kategori_berita->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $item->author->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->seen }}</td>
                        <td class="px-4 py-3 text-center flex justify-center gap-2">
                            <a href="#"
                               class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('admin.berita.edit', $item->slug) }}"
                               class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.berita.delete', $item->slug) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('POST')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Tidak ada berita ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $berita->links('pagination::tailwind') }}
    </div>
</div>

@endsection
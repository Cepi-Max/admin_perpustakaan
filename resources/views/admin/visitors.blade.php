@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengunjung Hari Ini</h1>

    <!-- Form Filter -->
    <form method="GET" action="{{ route('admin.visitors.filter') }}" class="mb-6 bg-white p-4 rounded shadow flex flex-col md:flex-row items-start md:items-end gap-4">
        <div class="flex flex-col">
            <label for="tanggal" class="text-sm font-medium text-gray-700 mb-1">Filter Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}"
                   class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2">
        </div>
        <div>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow mt-6 md:mt-0">
                Tampilkan
            </button>
        </div>
    </form>

    <!-- Tabel Data Pengunjung -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left border-b">NPM</th>
                    <th class="px-4 py-2 text-left border-b">Tanggal Kunjungan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($visitors as $visitor)
                    <tr>
                        <td class="px-4 py-2">{{ $visitor->npm }}</td>
                        <td class="px-4 py-2">{{ $visitor->visit_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-4 text-center text-gray-500">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

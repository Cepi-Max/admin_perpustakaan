@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Daftar Kritik & Saran <a href="{{ route('feedback.form') }}" class="text-blue-800 underline">Coba beri kritik saran</a></h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 text-sm rounded-lg shadow">
            <thead class="bg-gray-100 text-gray-700 text-center">
                <tr>
                    <th class="px-4 py-2 border-b">Nama</th>
                    <th class="px-4 py-2 border-b">Email</th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                    <th class="px-4 py-2 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-center">
                @foreach ($feedback as $item)
                    <tr>
                        <td class="px-4 py-2 align-middle">{{ $item->nama }}</td>
                        <td class="px-4 py-2 align-middle">{{ $item->email ?? '-' }}</td>
                        <td class="px-4 py-2 align-middle">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2 align-middle">
                            <a href="{{ route('admin.feedback.detail', $item->id) }}"
                            class="text-blue-600 hover:underline font-medium">
                            Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $feedback->links() }}
        </div>
    </div>
</div>
@endsection

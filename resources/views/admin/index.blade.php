@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Daftar Soal Kuis</h1>

    <form action="{{ route('admin.createQuestion') }}" method="POST" class="space-y-5 bg-white p-6 rounded-xl shadow">
        @csrf

        <div>
            <label for="jenis_soal" class="block text-sm font-medium text-gray-700">Jenis Soal</label>
            <select name="jenis_soal" id="jenis_soal" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
                <option value="umum">1. Umum</option>
                <option value="matematika">2. Matematika</option>
                <option value="polmanbabel">3. Kampus Polman Babel</option>
            </select>
        </div>

        <div>
            <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
            <input type="text" name="pertanyaan" id="pertanyaan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Pilihan Jawaban</label>
            <div class="space-y-2 mt-1">
                <input type="text" name="pilihan[]" placeholder="Pilihan 1" class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
                <input type="text" name="pilihan[]" placeholder="Pilihan 2" class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
                <input type="text" name="pilihan[]" placeholder="Pilihan 3" class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
            </div>
        </div>

        <div>
            <label for="jawaban_benar" class="block text-sm font-medium text-gray-700">Index Jawaban Benar (0, 1, 2...)</label>
            <input type="number" name="jawaban_benar" id="jawaban_benar" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
        </div>

        <div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">Tambah Soal</button>
        </div>
    </form>

    <h3 class="text-xl font-semibold mt-10 mb-4 text-gray-800">Daftar Soal</h3>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 bg-white rounded-lg shadow text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left border-b">Jenis</th>
                    <th class="px-4 py-2 text-left border-b">Pertanyaan</th>
                    <th class="px-4 py-2 text-left border-b">Pilihan</th>
                    <th class="px-4 py-2 text-left border-b">Jawaban Benar</th>
                    <th class="px-4 py-2 text-left border-b">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($questions as $question)
                    <tr>
                        <td class="px-4 py-2">{{ $question->jenis_soal }}</td>
                        <td class="px-4 py-2">{{ $question->pertanyaan }}</td>
                        <td class="px-4 py-2">
                            @php
                                $options = json_decode($question->pilihan_jawaban, true);
                            @endphp
                            @foreach ($options as $index => $option)
                                <div>{{ $index }}. {{ $option }}</div>
                            @endforeach
                        </td>
                        <td class="px-4 py-2">
                            @if (isset($options[$question->jawaban_benar]))
                                {{ $question->jawaban_benar }}. {{ $options[$question->jawaban_benar] }}
                            @else
                                <span class="text-red-600">Tidak Valid</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.editQuestion', $question->id) }}" class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a>
                                <form action="{{ route('admin.destroyQuestion', $question->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

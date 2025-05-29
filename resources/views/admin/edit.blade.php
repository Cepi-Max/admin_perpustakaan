@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Soal Kuis</h1>

    <form action="{{ route('admin.updateQuestion', $question->id) }}" method="POST" class="space-y-5 bg-white p-6 rounded-xl shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="jenis_soal" class="block text-sm font-medium text-gray-700">Jenis Soal:</label>
            <input type="text" name="jenis_soal" value="{{ old('jenis_soal', $question->jenis_soal) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
        </div>

        <div>
            <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Soal:</label>
            <input type="text" name="pertanyaan" value="{{ old('pertanyaan', $question->pertanyaan) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Pilihan:</label>
            <div class="space-y-2 mt-1">
                <input type="text" name="pilihan[]" value="{{ old('pilihan.0', json_decode($question->pilihan_jawaban)[0] ?? '') }}"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
                <input type="text" name="pilihan[]" value="{{ old('pilihan.1', json_decode($question->pilihan_jawaban)[1] ?? '') }}"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
                <input type="text" name="pilihan[]" value="{{ old('pilihan.2', json_decode($question->pilihan_jawaban)[2] ?? '') }}"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
            </div>
        </div>

        <div>
            <label for="jawaban_benar" class="block text-sm font-medium text-gray-700">Index Jawaban Benar (0, 1, 2...):</label>
            <input type="number" name="jawaban_benar" value="{{ old('jawaban_benar', $question->jawaban_benar) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2" required>
        </div>

        <div>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
                Update Soal
            </button>
        </div>
    </form>
</div>
@endsection

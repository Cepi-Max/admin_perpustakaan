@extends('admin.layouts.app')

@section('breadcrumb', 'Formulir Berita')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        {{ $beritaBySlug ? 'Formulir Ubah Berita' : 'Formulir Tambah Berita' }}
    </h2>

    {{-- Tombol Kelola Kategori --}}
    <div class="flex justify-end mb-4">
        <button type="button" onclick="toggleModal()"
            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded shadow">
            + Kelola Kategori
        </button>
    </div>

    {{-- Modal Form Kategori --}}
    <div id="kategoriModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl relative">
            <button onclick="toggleModal()" class="absolute top-2 right-3 text-gray-400 hover:text-red-600 text-xl">&times;</button>
            <h3 class="text-lg font-bold mb-4 text-gray-800">Kelola Kategori Berita</h3>

            {{-- Form Tambah Kategori --}}
            <form action="{{ route('admin.kategori-berita.save') }}" method="POST" class="space-y-4 mb-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Warna Label</label>
                        <input type="color" name="color"
                            class="w-16 h-10 p-0 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                        Simpan Kategori
                    </button>
                </div>
            </form>

            {{-- Daftar Kategori --}}
            <div class="border-t pt-4">
                <h4 class="text-md font-semibold mb-3 text-gray-700">Daftar Kategori</h4>
                @if($categories->count())
                    <ul class="divide-y divide-gray-200 max-h-64 overflow-y-auto">
                        @foreach ($categories as $kategori)
                            <li class="flex items-center justify-between py-2">
                                <div class="flex items-center gap-3">
                                    <span class="inline-block w-4 h-4 rounded-full" style="background-color: {{ $kategori->color }}"></span>
                                    <span class="text-sm text-gray-800">{{ $kategori->name }}</span>
                                </div>
                                <form action="{{ route('admin.kategori-berita.delete', $kategori->slug) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 text-sm font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Belum ada kategori.</p>
                @endif
            </div>
        </div>
    </div>


    {{-- Form Berita --}}
    <form action="{{ $beritaBySlug ? route('admin.berita.update', $beritaBySlug->slug) : route('admin.berita.store') }}"
        method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded-lg shadow-md space-y-6">
        @csrf

        {{-- Judul --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Judul</label>
            <input type="text" name="title" value="{{ old('title', $beritaBySlug->title ?? '') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">
        </div>

        {{-- Kategori --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Kategori --}}
            <div>
                <label class="block mb-1 font-medium text-gray-700">Kategori</label>
                <select name="kategori_berita_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ (string) old('kategori_berita_id', $beritaBySlug->berita_category_id ?? '') === (string) $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block mb-1 font-medium text-gray-700">Tanggal</label>
                <input type="date" name="created_at" value="{{ date('Y-m-d') }}" disabled
                    class="w-full px-4 py-2 bg-gray-100 text-gray-500 border border-gray-300 rounded-md cursor-not-allowed focus:outline-none">
            </div>
        </div>


        {{-- Isi Artikel --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Isi Berita</label>
            <textarea class="summernote w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500" name="body" id="body" rows="15" placeholder="Tulis berita disini...">{{ old('body', $beritaBySlug->body ?? ''); }}</textarea>
        </div>

        {{-- Upload Gambar --}}
        <div>
            <label for="image-input" class="block mb-2 font-medium text-gray-700">Upload Gambar</label>

            <div id="drop-area"
                class="relative flex items-center justify-center w-full h-64 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer transition hover:border-blue-500 bg-gray-50"
                onclick="document.getElementById('image-input').click()"
                ondragover="event.preventDefault(); this.classList.add('border-blue-500')"
                ondragleave="this.classList.remove('border-blue-500')"
                ondrop="handleDrop(event)">

                {{-- Preview Gambar --}}
                <img id="image-preview"
                    src="{{ $beritaBySlug && $beritaBySlug->image ? asset('storage/images/publicImg/article/articleImg/' . $beritaBySlug->image) : '' }}"
                    class="absolute inset-0 object-contain w-full h-full {{ $beritaBySlug && $beritaBySlug->image ? '' : 'hidden' }}"
                    alt="Preview Gambar">

                {{-- Overlay Instruksi --}}
                <div id="upload-overlay"
                    class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 transition-opacity duration-200
                        {{ $beritaBySlug && $beritaBySlug->image ? 'bg-black/50 text-white opacity-0 group-hover:opacity-100' : 'text-gray-500' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-10 h-10 mb-2 {{ $beritaBySlug && $beritaBySlug->image ? 'text-white' : 'text-gray-400' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 16v-8m0 0l-4 4m4-4l4 4M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1" />
                    </svg>

                    <p class="text-sm">
                        {{ $beritaBySlug && $beritaBySlug->image ? 'Klik atau drag gambar untuk mengganti' : 'Klik atau drag gambar ke sini untuk mengunggah' }}
                    </p>
                </div>

                {{-- Input File --}}
                <input type="file" name="image" id="image-input" accept="image/*"
                    class="hidden" onchange="previewImage(event)">
            </div>
        </div>

        
        {{-- Tombol Submit --}}
        <div class="text-right">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow">
                {{ $beritaBySlug ? 'Perbarui' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>

{{-- @section('scripts') --}}
<script>
    function toggleModal() {
        document.getElementById('kategoriModal').classList.toggle('hidden');
    }

    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const overlay = document.getElementById('upload-overlay');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                overlay.classList.add('opacity-0'); // hide text
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function handleDrop(event) {
        event.preventDefault();
        const input = document.getElementById('image-input');
        input.files = event.dataTransfer.files;
        previewImage({ target: input });
    }

    // Hide overlay if preview image already exists (for edit form)
    window.addEventListener('DOMContentLoaded', () => {
        const preview = document.getElementById('image-preview');
        const overlay = document.getElementById('upload-overlay');

        if (preview && preview.src && !preview.classList.contains('hidden')) {
            overlay.classList.add('opacity-0');
        }
    });
</script>
@endsection

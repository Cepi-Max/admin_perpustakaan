@extends('admin.layouts.app')

@section('breadcrumb', 'Form Iklan')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow-md">
  <h1 class="text-2xl font-bold text-gray-800 mb-4">
    {{ isset($iklan) ? 'Ubah Iklan' : 'Tambah Iklan' }}
  </h1>

  <form action="{{ isset($iklan) ? route('admin.iklan.update', $iklan->id) : route('admin.iklan.store') }}"
        method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($iklan))
      @method('POST')
    @endif

    {{-- Gambar --}}
    <div class="mb-6">
      <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
      <div id="drop-area"
           class="relative w-full h-64 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden cursor-pointer group hover:border-gray-400">
        <input type="file" name="gambar" id="gambar" accept="image/*"
               class="absolute w-full h-full opacity-0 z-10 cursor-pointer"
               onchange="previewImage(event)">
        <div class="flex items-center justify-center w-full h-full">
          <img id="preview"
               src="{{ isset($iklan) && $iklan->gambar ? asset('storage/' . $iklan->gambar) : '' }}"
               alt="Preview Gambar"
               class="max-h-full max-w-full object-contain {{ isset($iklan) && $iklan->gambar ? '' : 'hidden' }}">
          <div id="upload-label"
               class="text-center text-gray-500 {{ isset($iklan) && $iklan->gambar ? 'hidden' : '' }}">
            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 16l4-4a4 4 0 015.656 0L21 4M8 16h.01M12 20h.01M16 16h.01" />
            </svg>
            <p class="text-sm">Klik / tarik gambar ke sini</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Deskripsi --}}
    <div class="mb-4">
      <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-500"
                required>{{ old('deskripsi', $iklan->deskripsi ?? '') }}</textarea>
    </div>

    {{-- Tombol Simpan --}}
    <div class="text-right">
      <button type="submit"
              class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
        {{ isset($iklan) ? 'Update' : 'Simpan' }}
      </button>
    </div>
  </form>
</div>

@push('scripts')
<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
      document.getElementById('preview').src = reader.result;
      document.getElementById('preview').classList.remove('hidden');
      document.getElementById('upload-label').classList.add('hidden');
    }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
@endpush
@endsection

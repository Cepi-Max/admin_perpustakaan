@extends('admin.layouts.app')

@section('content')
<div x-data="galleryViewer()" class="relative">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Galeri Perpustakaan</h1>
    <a href="{{ route('admin.galeri.form') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-700 transition">
      + Tambah
    </a>
  </div>

  <form method="POST" action="{{ route('admin.galeri.delete') }}">
    @csrf
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @forelse ($galeris as $index => $galeri)
        <div class="relative bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
          <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-48 object-cover cursor-pointer" @click="openPopup({{ $index }})">
          <input type="checkbox" name="ids[]" value="{{ $galeri->id }}"
                 class="absolute bottom-2 right-2 w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500 bg-white shadow-md z-10">
          <div class="p-4">
            <h2 class="font-semibold text-lg text-gray-800">{{ $galeri->judul }}</h2>
            <p class="text-sm text-gray-600 mt-1">{{ $galeri->deskripsi }}</p>
            <p class="text-xs text-gray-400 mt-2 italic">
              {{ \Carbon\Carbon::parse($galeri->tanggal_upload)->translatedFormat('d F Y') }}
            </p>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-10 text-gray-500">
          Belum ada gambar di galeri.
        </div>
      @endforelse
    </div>

    <div class="text-right mt-4">
      <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700">
        Hapus Terpilih
      </button>
    </div>
  </form>

  <!-- Popup Viewer -->
  <div x-show="isOpen" x-transition @click.self="isOpen = false"
       class="fixed inset-0 bg-black text-white flex items-center justify-center z-50" @click="isOpen = false">
    <div class="absolute inset-0 z-40" @click="isOpen = false"></div>
    <div class="relative max-w-6xl w-full z-50" @click="isOpen = false">
      <button @click="prevImage"
              class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full px-4 py-2" @click.stop>◀</button>
      <img :src="activeImage" alt="Detail Gambar" class="rounded-lg max-h-[80vh] mx-auto">
      <button @click="nextImage"
              class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full px-4 py-2" @click.stop>▶</button>
    </div>
  </div>
</div>

@push('scripts')
<script>
  function galleryViewer() {
    return {
      isOpen: false,
      activeImage: '',
      currentIndex: 0,
      imageList: @json($galeris->pluck('gambar')->map(fn($g) => asset('storage/' . $g)) ?? []),
      openPopup(index) {
        this.currentIndex = index;
        this.activeImage = this.imageList[this.currentIndex];
        this.isOpen = true;
      },
      nextImage() {
        this.currentIndex = (this.currentIndex + 1) % this.imageList.length;
        this.activeImage = this.imageList[this.currentIndex];
      },
      prevImage() {
        this.currentIndex = (this.currentIndex - 1 + this.imageList.length) % this.imageList.length;
        this.activeImage = this.imageList[this.currentIndex];
      }
    }
  }
</script>
@endpush
@endsection

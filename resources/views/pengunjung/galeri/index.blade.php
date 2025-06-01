@extends('pengunjung.layouts.app') {{-- sesuaikan dengan layout utama kamu --}}

@section('title', $title)

@section('content')
    <section class="py-20 ">
        <div class="container mx-auto px-6">
            <div
                class="text-center mb-16 bg-gradient-to-r from-blue-100 via-white to-blue-200 py-12 px-4 rounded-3xl shadow-xl">
                <span class="text-blue-600 font-semibold text-sm md:text-base tracking-wide uppercase animate-pulse">
                    OUR GALLERY
                </span>
                <h2
                    class="text-4xl md:text-5xl font-extrabold text-gray-900 mt-4 leading-tight tracking-tight drop-shadow-md">
                    Captured Moments
                </h2>
                <p class="max-w-3xl mx-auto text-gray-700 mt-6 text-lg md:text-xl font-medium leading-relaxed">
                    A visual journey through our most <span class="text-blue-500 font-semibold">memorable events</span> and
                    <span class="text-blue-600 font-semibold">impactful projects</span>.
                </p>
            </div>


            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($galeri as $item)
                    <div class="group relative overflow-hidden rounded-lg aspect-square shadow-sm">
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-white text-xl font-bold">{{ $item->judul }}</h3>
                                <p class="text-white/80 mt-1">
                                    {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('F Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada foto di galeri.</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="text-center mt-16">
                {{ $galeri->links('pagination::tailwind') }}
            </div>
        </div>
    </section>
@endsection

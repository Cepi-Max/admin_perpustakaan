@extends('pengunjung.layouts.app')
@section('title', $title)

@section('content')
    <div class="w-full min-h-screen flex flex-col items-center justify-center  bg-gray-50">
        <div
            class="mb-10 text-center bg-gradient-to-r from-blue-600 via-blue-500 to-blue-400 rounded-xl p-10 shadow-lg w-full">
            <h1 class="text-5xl font-extrabold text-white mb-4 chelsea-market-regular drop-shadow-md">
                Berita Terbaru & Terupdate
            </h1>
            <p class="text-blue-100 max-w-3xl mx-auto text-xl leading-relaxed">
                Temukan berita terkini, artikel mendalam, dan update penting seputar topik favorit Anda.
                Gunakan fitur pencarian untuk mencari berita berdasarkan kata kunci dengan mudah dan cepat.
            </p>
            <form action="{{ route('guest.berita') }}" method="GET" class="w-full max-w-3xl mx-auto my-6">
                <label for="search" class="sr-only">Cari Berita</label>
                <div class="relative w-full">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Cari berita, topik, atau kata kunci..."
                        class="w-full border border-blue-400 rounded-full py-4 px-6 pl-14 text-gray-800 placeholder-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-300 shadow-md transition"
                        autocomplete="off" />
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                        <ion-icon name="search-outline" class="text-blue-400 text-2xl"></ion-icon>
                    </div>
                    <button type="submit"
                        class="absolute right-1 top-1/2 -translate-y-1/2 bg-blue-700 hover:bg-blue-800 text-white rounded-full px-6 py-3 text-base font-semibold shadow-lg transition">
                        Cari
                    </button>
                </div>
            </form>
        </div>





        <div class="px-4 md:px-[2rem] xl:px-[6rem] w-full max-w-7xl">
            @if ($berita->count() > 0)
                @php
                    $groupedBerita = $berita->chunk(3);
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    @foreach ($groupedBerita as $group)
                        <div class="space-y-6">
                            @foreach ($group as $item)
                                <div
                                    class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300 h-[300px] flex flex-col">
                                    @if ($item->image)
                                        <div class="relative">
                                            <img class="w-full h-32 object-cover"
                                                src="{{ asset('storage/images/publicImg/article/articleImg/' . $item->image) }}"
                                                alt="{{ $item->title }}">
                                            <div class="absolute top-2 right-2">
                                                <span class="bg-blue-600 text-white px-2 py-1 rounded text-xs font-medium">
                                                    {{ $item->kategori_berita->nama }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="p-4 flex flex-col">
                                        <div>
                                            <div class="flex flex-wrap gap-3 text-xs text-gray-500 mb-2">
                                                <span class="flex gap-1 items-center">
                                                    <ion-icon name="person-outline" class="text-blue-600"></ion-icon>
                                                    {{ $item->author->name }}
                                                </span>
                                                <span class="flex gap-1 items-center">
                                                    <ion-icon name="calendar-outline" class="text-blue-600"></ion-icon>
                                                    {{ $item->created_at->format('d M Y') }}
                                                </span>
                                            </div>

                                            <h4 class="text-lg font-semibold text-blue-900 mb-2 leading-tight line-clamp-2">
                                                <a href="{{ route('guest.berita.show', $item->slug) }}"
                                                    class="hover:text-blue-600 transition-colors">
                                                    {{ $item->title }}
                                                </a>
                                            </h4>

                                            <p class="text-sm text-gray-600 mb-3 leading-relaxed line-clamp-3">
                                                {{ strip_tags($item->body) }}
                                            </p>
                                        </div>

                                        <div class="mt-auto">
                                            <a href="{{ route('guest.berita.show', $item->slug) }}"
                                                class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1 transition-colors">
                                                <span>Baca Selengkapnya</span>
                                                <ion-icon name="chevron-forward-outline" class="text-xs"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-2">
                        {{ $berita->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <ion-icon name="newspaper-outline" class="text-6xl text-gray-300 mb-4"></ion-icon>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Berita</h3>
                        <p class="text-gray-500">Berita akan ditampilkan di sini setelah dipublikasikan.</p>
                    </div>
                </div>
            @endif
        </div>

    </div>



    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection

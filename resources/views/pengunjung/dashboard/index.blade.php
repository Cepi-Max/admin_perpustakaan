@extends('pengunjung.layouts.app')
@section('title', $title)
@section('content')
    <div class="bg-slate-50 min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <!-- Hero Section -->
            <div
                class="bg-gradient-to-r from-blue-100 via-blue-200 to-blue-300 rounded-xl shadow-md p-8 mb-12 flex flex-col md:flex-row items-center justify-between gap-8">
                <!-- Text Section -->
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-4xl font-extrabold text-blue-800 mb-4">Selamat Datang di Portal Informasi Kami</h2>
                    <p class="text-slate-700 text-lg mb-6">
                        Temukan berita terbaru, informasi penting, dan berbagai sponsor menarik di satu tempat. Portal ini
                        dibuat
                        untuk memberi Anda kemudahan dalam mengakses data dan kabar terkini.
                    </p>
                    <a href="#berita"
                        class="inline-block bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                        Lihat Berita Terbaru
                    </a>
                </div>

                <!-- Icon Section -->
                <div class="flex-1">
                    <img src="{{ asset('images/hero-news.svg') }}" alt="Hero Icon" class="w-full max-w-sm mx-auto">
                </div>
            </div>

            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-blue-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15">
                            </path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-800">Berita Terbaru</h1>
                </div>
                <div class="h-1 w-20 bg-blue-600 rounded-full"></div>
            </div>

            <!-- Berita Section -->
            <!-- Slider Wrapper -->
            <div class="swiper mySwiper mb-12">
                <div class="swiper-wrapper">
                    @foreach ($berita as $item)
                        <div class="swiper-slide">
                            <div
                                class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-300 overflow-hidden">
                                @if ($item->image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/images/publicImg/article/articleImg/' . $item->image) }}"
                                            alt="{{ $item->title }}" class="w-full h-52 object-cover">
                                        <div class="absolute top-4 left-4">
                                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                                {{ $item->kategori_berita->nama }}
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <h3
                                        class="text-xl font-bold text-slate-800 mb-3 leading-tight hover:text-blue-600 transition-colors">
                                        {{ $item->title }}
                                    </h3>

                                    <div class="flex items-center gap-4 mb-4 text-sm text-slate-600">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            <span>{{ $item->author->name }}</span>
                                        </div>
                                    </div>

                                    <p class="text-slate-700 leading-relaxed mb-4">
                                        {{ Str::limit(strip_tags($item->body), 120) }}
                                    </p>

                                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                                        <div class="flex items-center gap-4 text-sm text-slate-500">
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>{{ $item->inovator }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                <span>{{ $item->seen }} dilihat</span>
                                            </div>
                                        </div>

                                        <a href="{{ route('guest.berita.show', $item->slug) }}"
                                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                            <span>Baca Selengkapnya</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation buttons -->
                <div class="flex justify-end mt-4 gap-2">
                    <div class="swiper-button-prev  text-blue rounded-full p-4"></div>
                    <div class="swiper-button-next   text-blue rounded-full p-4"></div>
                </div>
            </div>




            <!-- Iklan Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-emerald-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Sponsor & Iklan</h2>
                </div>
                <div class="h-1 w-16 bg-emerald-600 rounded-full mb-8"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($iklan as $ad)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300 overflow-hidden group">
                        @if ($ad->gambar)
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $ad->gambar) }}" alt="Iklan"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute top-3 right-3">
                                    <div class="bg-emerald-600 text-white px-2 py-1 rounded-full text-xs font-medium">
                                        Sponsor
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="p-5">
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-emerald-50 rounded-lg flex-shrink-0">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m0 0V1a1 1 0 011-1h2a1 1 0 011 1v18a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1h2a1 1 0 011 1v3">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-slate-700 leading-relaxed text-sm">{{ $ad->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                1024: {
                    slidesPerView: 2, // dua berita saat layar besar
                    spaceBetween: 32,
                }
            }
        });
    </script>
@endsection

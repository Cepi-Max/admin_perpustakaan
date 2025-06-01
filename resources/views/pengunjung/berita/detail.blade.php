@extends('pengunjung.layouts.app')
@section('title', $title)

@section('content')
    <div class="w-full min-h-screen bg-gray-50 py-10">
        <div class="container mx-auto px-4 md:px-[2rem] xl:px-[6rem] max-w-6xl">

            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('guest.berita.index') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <ion-icon name="home-outline" class="mr-2"></ion-icon>
                            Berita
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ion-icon name="chevron-forward-outline" class="text-gray-400"></ion-icon>
                            <span
                                class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $detailBerita->kategori_berita->nama }}</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <ion-icon name="chevron-forward-outline" class="text-gray-400"></ion-icon>
                            <span
                                class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($detailBerita->title, 30) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">

                        <!-- Featured Image -->
                        @if ($detailBerita->image)
                            <div class="relative">
                                <img class="w-full h-80 object-cover"
                                    src="{{ asset('storage/images/publicImg/article/articleImg/' . $detailBerita->image) }}"
                                    alt="{{ $detailBerita->title }}">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-600 text-white px-3 py-2 rounded-full text-sm font-semibold">
                                        {{ $detailBerita->kategori_berita->nama }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div class="p-8">
                            <!-- Article Header -->
                            <header class="mb-6">
                                <h1
                                    class="text-3xl md:text-4xl font-bold text-blue-900 chelsea-market-regular leading-tight mb-4">
                                    {{ $detailBerita->title }}
                                </h1>

                                <!-- Article Meta -->
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <ion-icon name="person-outline" class="text-blue-600"></ion-icon>
                                        </div>
                                        <span class="font-medium">{{ $detailBerita->author->name }}</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <ion-icon name="calendar-outline" class="text-blue-600"></ion-icon>
                                        </div>
                                        <span>{{ $detailBerita->created_at->format('d F Y') }}</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <ion-icon name="eye-outline" class="text-blue-600"></ion-icon>
                                        </div>
                                        <span>{{ $detailBerita->views ?? 0 }} views</span>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div class="flex flex-wrap gap-2">
                                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                        #{{ strtolower(str_replace(' ', '', $detailBerita->kategori_berita->nama)) }}
                                    </span>
                                    @if ($detailBerita->inovator)
                                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                            #{{ strtolower(str_replace(' ', '', $detailBerita->inovator)) }}
                                        </span>
                                    @endif
                                </div>
                            </header>

                            <!-- Article Content -->
                            <div class="prose prose-lg max-w-none">
                                <div class="text-gray-700 leading-relaxed space-y-4">
                                    {!! nl2br(e($detailBerita->body)) !!}
                                </div>
                            </div>

                            <!-- Article Footer -->
                            <footer class="mt-8 pt-6 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm text-gray-600">Bagikan artikel ini:</span>
                                        <div class="flex gap-2">
                                            <a href="#"
                                                class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                <ion-icon name="logo-facebook"></ion-icon>
                                            </a>
                                            <a href="#"
                                                class="w-8 h-8 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition-colors">
                                                <ion-icon name="logo-twitter"></ion-icon>
                                            </a>
                                            <a href="#"
                                                class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                                <ion-icon name="logo-whatsapp"></ion-icon>
                                            </a>
                                        </div>
                                    </div>

                                    <a href="{{ route('guest.berita.index') }}"
                                        class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                        <ion-icon name="arrow-back-outline"></ion-icon>
                                        <span>Kembali ke Berita</span>
                                    </a>
                                </div>
                            </footer>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Related Articles -->
                    @if ($relatedBerita->count() > 0)
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 mb-6">
                            <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center gap-2">
                                <ion-icon name="bookmark-outline" class="text-blue-600"></ion-icon>
                                Berita Terkait
                            </h3>

                            <div class="space-y-4">
                                @foreach ($relatedBerita as $related)
                                    <article class="border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
                                        @if ($related->image)
                                            <div class="mb-3">
                                                <img class="w-full h-32 object-cover rounded-lg"
                                                    src="{{ asset('storage/images/publicImg/article/articleImg/' . $related->image) }}"
                                                    alt="{{ $related->title }}">
                                            </div>
                                        @endif

                                        <div class="space-y-2">
                                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                                <ion-icon name="calendar-outline"></ion-icon>
                                                <span>{{ $related->created_at->format('d M Y') }}</span>
                                            </div>

                                            <h4 class="font-semibold text-blue-900 leading-tight">
                                                <a href="{{ route('guest.berita.show', $related->slug) }}"
                                                    class="hover:text-blue-600 transition-colors">
                                                    {{ Str::limit($related->title, 80) }}
                                                </a>
                                            </h4>

                                            <p class="text-sm text-gray-600">
                                                {{ Str::limit(strip_tags($related->body), 100) }}
                                            </p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Author Info -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center gap-2">
                            <ion-icon name="person-circle-outline" class="text-blue-600"></ion-icon>
                            Tentang Penulis
                        </h3>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <ion-icon name="

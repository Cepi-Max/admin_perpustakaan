@extends('pengunjung.layouts.app')
@section('Detail Berita', $title)

@section('content')

  <!-- Breadcrumb -->
  <div class="breadcrumb-custom " style="margin-top: 150px;">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('guest.dashboard') }}">Beranda</a></li>
          <li class="breadcrumb-item"><a href="{{ route('guest.berita') }}">Berita</a></li>
          <li class="breadcrumb-item active">{{ $detailBerita->title }}</li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container my-5">
    <div class="row">
      <div class="col-lg-8">
        
        <!-- Article -->
        <article>
          <div class="article-header">
            <h1 class="article-title">{{ $detailBerita->title }}</h1>
            <div class="article-meta">
              <span class="meta-item">
                <i class="fas fa-calendar-alt"></i>
                {{ $detailBerita->created_at }}
              </span>
              <span class="meta-item">
                <i class="fas fa-user"></i>
                {{ $detailBerita->author->name }}
              </span>
              <span class="meta-item">
                <i class="fas fa-eye"></i>
                {{ $detailBerita->seen }} views
              </span>
            </div>
          </div>

          <img src="{{ asset('storage/berita/'. $detailBerita->image) }}" class="article-image" alt="{{ $detailBerita->title }}">

          <div class="article-content">
            {{ strip_tags($detailBerita->body) }}
          </div>
        </article>

      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <div class="sticky-top" style="top: 100px;">
          
          <!-- Popular News -->
          <div class="card sidebar-card">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0"><i class="fas fa-fire me-2"></i>Berita Populer</h5>
            </div>
            <div class="card-body">
                @foreach ($beritaPopuler as $bp)       
                    <div class="d-flex align-items-center mb-3">
                      <img src="{{ asset('storage/berita/' . $bp->image) }}"
                          class="rounded me-3 flex-shrink-0"
                          alt="{{ $bp->title }}"
                          style="width: 80px; height: 60px; object-fit: cover;">

                      <div class="flex-grow-1">
                          <h6 class="mb-1">
                              <a href="{{ route('guest.berita.show', $bp->slug) }}" class="text-decoration-none text-dark">
                                  {{ $bp->title }}
                              </a>
                          </h6>
                          <small class="text-muted">{{ $bp->created_at->format('d M Y') }}</small>
                      </div>
                  </div>
                @endforeach
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>

@endsection
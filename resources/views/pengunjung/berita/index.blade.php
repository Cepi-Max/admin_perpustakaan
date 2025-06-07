@extends('pengunjung.layouts.app')
@section('Berita', $title)

@section('content')
<div class="container" style="margin-top: 150px;">
  <div class="row">
    <!-- Konten Berita -->
    <div class="col-lg-8">
      <!-- Pencarian dan Filter -->
      <form method="GET" action="{{ route('guest.berita') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-8">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berita..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                <i class="icon-search"></i>
                </button>
            </div>
            </div>
            <div class="col-md-4">
            <select class="form-select" name="sort" onchange="this.form.submit()">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul A-Z</option>
            </select>
            </div>
        </div>
        </form>


      <!-- Grid Berita -->
      <div class="row" id="newsContainer">
        @foreach ($berita as $brt)
        <div class="col-md-6 mb-4 news-item" data-date="{{ $brt->created_at }}" data-title="{{ $brt->title }}">
          <div class="card h-100 shadow-sm">
            <img src="{{ asset('storage/berita/'. $brt->image) }}" class="card-img-top" alt="{{ $brt->title }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <div class="text-muted mb-2 small">
                <i class="fas fa-calendar-alt"></i> {{ date('d M Y', strtotime($brt->created_at)) }}
                <span class="ms-3"><i class="fas fa-user"></i> Admin</span>
              </div>
              <h5 class="card-title">{{ $brt->title }}</h5>
              <p class="card-text">{{ Str::limit(strip_tags($brt->body), 100) }}</p>
              <a href="{{ route('guest.berita.show', $brt->slug) }}" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Navigasi Halaman -->
      <div class="d-flex justify-content-center">
        {{ $berita->links() }}
      </div>
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
</div>
@endsection

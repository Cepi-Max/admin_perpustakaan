@extends('pengunjung.layouts.app')
@section('Beranda', $title)

@section('content')

    <div class="hero-slide owl-carousel site-blocks-cover" style="margin-top: 100px;">
      @forelse ($iklan as $ik) 
        <div class="intro-section position-relative" style="height: 450px; overflow: hidden;">
          <img src="{{ asset('storage/' . $ik->gambar) }}" 
              alt="{{ $ik->deskripsi }}"
              class="position-absolute top-0 start-0 w-100 h-100"
              style="object-fit: cover;">
        </div>
      @empty
        
      @endforelse
      
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-4 mb-5">
            <h2 class="section-title-underline mb-5">
              <span>Galeri Perpustakaan</span>
            </h2>
          </div>
        </div>

        <div class="row">
          @forelse ($galeri as $gl)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card border-0 shadow h-100">
                <div style="height: 250px; overflow: hidden;">
                  <img src="{{ asset('storage/' . $gl->gambar) }}"
                      class="card-img-top w-100 h-100"
                      style="object-fit: cover;"
                      alt="{{ $gl->judul }}">
                </div>
                <div class="card-body text-center">
                  <h5 class="card-title">{{ $gl->judul }}</h5>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center">
              <img src="{{ asset('images/empty-gallery.svg') }}" alt="Galeri Kosong" style="max-width: 300px;" class="mb-4">
              <h5 class="text-muted">Oops! Belum ada foto di galeri saat ini.</h5>
              <p class="text-muted">Kami sedang menyiapkan koleksi terbaik untuk ditampilkan di sini. Silakan cek kembali nanti ya! 📸</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>


    <div class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
              <div class="col-lg-6 mb-5">
                  <h2 class="section-title-underline mb-3">
                  <span>Berita Terkini</span>
                  </h2>
                  <p>Berita terbaru seputar kegiatan dan informasi di perpustakaan kami.</p>
              </div>
            </div>

            <div class="row">
              @forelse ($berita as $brt)
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card h-100 d-flex flex-column">
                    <div style="height: 200px; overflow: hidden;">
                      <img src="{{ asset('storage/berita/' . $brt->image) }}"
                          class="w-100 h-100"
                          style="object-fit: cover;"
                          alt="{{ $brt->title }}">
                    </div>
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title">{{ $brt->title }}</h5>
                      <p class="card-text" style="flex-grow: 1; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                        {!! strip_tags(Str::limit($brt->body, 200)) !!}
                      </p>
                      <a href="{{ route('guest.berita.show', $brt->slug) }}" class="btn btn-sm btn-success mt-auto">
                        Baca Selengkapnya
                      </a>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12 text-center">
                  <img src="{{ asset('images/empty-news.svg') }}" alt="Tidak ada berita" style="max-width: 300px;" class="mb-4">
                  <h5 class="text-muted">Belum ada berita yang tersedia</h5>
                  <p class="text-muted">Berita terbaru akan segera hadir di halaman ini. Pantau terus untuk informasi menarik dari kami! 📰</p>
                </div>
              @endforelse
            </div>
        </div>
    </div>


    <div class="section-bg style-1">
        <div class="container">
            <div class="row">
              <!-- Kolom Kiri -->
              <div class="col-lg-4 mb-5 mb-lg-0">
                  <h2 class="section-title-underline style-2">
                  <span>Kritik & Saran</span>
                  </h2>
                  <p class="text-white">Kami sangat menghargai setiap masukan dari Anda. Silakan isi form berikut untuk membantu kami terus berkembang dan memberikan pelayanan terbaik.</p>
              </div>

              <!-- Kolom Kanan: Form Feedback -->
              <div class="col-lg-8">
                  <form action="{{ route('guest.feedback.store') }}" method="POST" class="bg-white p-4 rounded shadow">
                  @csrf

                  <div class="row">
                      <div class="col-md-6 mb-3">
                      <input type="text" name="nama" placeholder="Nama"
                          class="form-control" required>
                      </div>
                      <div class="col-md-6 mb-3">
                      <input type="text" name="no_hp" placeholder="No.Handphone / WhatsApp"
                          class="form-control">
                      </div>
                  </div>

                  <div class="mb-3">
                      <input type="email" name="email" placeholder="Email*" class="form-control" required>
                  </div>

                  <div class="mb-3">
                      <textarea name="kritik" rows="3" placeholder="Masukkan kritikan Anda" class="form-control"></textarea>
                  </div>

                  <div class="mb-4">
                      <textarea name="saran" rows="3" placeholder="Saran Anda kepada kami" class="form-control"></textarea>
                  </div>

                  <div>
                      <button type="submit"
                          class="btn btn-success px-4 py-2 rounded-0 text-white">
                          Kirim
                      </button>
                  </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
@endsection
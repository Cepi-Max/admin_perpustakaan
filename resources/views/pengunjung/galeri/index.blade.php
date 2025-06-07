@extends('pengunjung.layouts.app')
@section('title', $title)

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content text-center" data-aos="fade-up">
            <h1 class="hero-title">
                <i class="fas fa-images me-3"></i>
                Galeri Perpustakaan
            </h1>
            <p class="hero-subtitle">
                Jelajahi koleksi foto dan momen berharga dari perpustakaan kami yang menginspirasi dan mendukung kegiatan literasi
            </p>
        </div>
    </div>
</div>

<!-- Gallery Section -->
<div class="site-section gallery-section">
    <div class="container">
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-lg-6 mb-5">
                <h2 class="section-title-underline mb-3">
                    <span>Koleksi Galeri</span>
                </h2>
                <p>Dokumentasi kegiatan, fasilitas, dan suasana perpustakaan yang menginspirasi dalam perjalanan literasi bersama</p>
            </div>
        </div>

        <div class="row gallery-grid">
            @forelse ($galeri as $gl)
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card border-0 shadow h-100 gallery-card">
                        <div class="gallery-image-container">
                            <img src="{{ asset('storage/' . $gl->gambar) }}"
                                class="card-img-top gallery-image"
                                alt="{{ $gl->judul }}">
                            <div class="gallery-overlay">
                                <button class="view-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#imageModal" 
                                        onclick="showImage('{{ asset('storage/' . $gl->gambar) }}', '{{ $gl->judul }}', '{{ $gl->created_at->format('d M Y') }}')">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center gallery-content">
                            <h5 class="card-title gallery-title">{{ $gl->judul }}</h5>
                            <div class="gallery-meta">
                                <span><i class="fas fa-calendar-alt"></i> {{ $gl->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center" data-aos="fade-up">
                    <div class="empty-state">
                        <i class="fas fa-images"></i>
                        <h3>Oops! Belum ada foto di galeri saat ini.</h3>
                        <p>Kami sedang menyiapkan koleksi terbaik untuk ditampilkan di sini. Silakan cek kembali nanti ya! 📸</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($galeri->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="pagination-wrapper" data-aos="fade-up">
                        {{ $galeri->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Detail Galeri</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid">
                <div class="modal-info">
                    <h6 id="modalTitle" class="mb-2"></h6>
                    <small id="modalDate" class="text-muted"></small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
    --bg-light: #f8f9fa;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: var(--text-dark);
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 120px 0 80px;
    margin-top: 100px;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="books" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect width="20" height="20" fill="none"/><path d="M2 2h4v16h-4z M8 2h4v16h-4z M14 2h4v16h-4z" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23books)"/></svg>') repeat;
    opacity: 0.1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

/* Gallery Section */
.gallery-section {
    padding: 80px 0;
    background-color: var(--bg-light);
}

.section-title-underline {
    position: relative;
    display: inline-block;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

.section-title-underline span {
    position: relative;
    z-index: 2;
}

.gallery-grid {
    margin-bottom: 60px;
}

.gallery-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
    background: white;
}

.gallery-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}

.gallery-image-container {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-card:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.view-btn {
    background: var(--accent-color);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
}

.view-btn:hover {
    background: #c0392b;
    transform: scale(1.05);
    color: white;
}

.gallery-content {
    padding: 25px;
}

.gallery-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 10px;
    line-height: 1.4;
}

.gallery-meta {
    color: var(--text-light);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

.gallery-meta i {
    color: var(--secondary-color);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: var(--text-light);
    max-width: 500px;
    margin: 0 auto;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 20px;
    color: var(--text-light);
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: var(--text-dark);
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.pagination {
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.page-link {
    border: none;
    padding: 12px 20px;
    color: var(--primary-color);
    background: white;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: var(--secondary-color);
    color: white;
}

.page-item.active .page-link {
    background: var(--primary-color);
    color: white;
}

.page-item.disabled .page-link {
    color: var(--text-light);
    background: #f8f9fa;
}

/* Modal Styles */
.modal-content {
    border-radius: 15px;
    border: none;
    overflow: hidden;
}

.modal-header {
    background: var(--primary-color);
    color: white;
    border: none;
}

.modal-body {
    padding: 0;
}

.modal-body img {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: contain;
}

.modal-info {
    padding: 20px;
}

.modal-info h6 {
    color: var(--primary-color);
    font-weight: 600;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section {
        padding: 100px 0 60px;
        margin-top: 80px;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .section-title-underline {
        font-size: 2rem;
    }
    
    .section-title-underline:after {
        width: 80px;
    }
    
    .gallery-section {
        padding: 60px 0;
    }
    
    .gallery-card {
        margin-bottom: 1.5rem;
    }
    
    .gallery-image-container {
        height: 200px;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .view-btn {
        padding: 10px 20px;
        font-size: 0.8rem;
    }
}

/* AOS Animations */
[data-aos="fade-up"] {
    opacity: 0;
    transform: translate3d(0, 40px, 0);
    transition-property: transform, opacity;
}

[data-aos="fade-up"].aos-animate {
    opacity: 1;
    transform: translate3d(0, 0, 0);
}

/* Loading Animation */
.loading {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255,255,255,.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

<script>
// Initialize AOS if available
document.addEventListener('DOMContentLoaded', function() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    }
});

// Show image in modal
function showImage(imageSrc, imageTitle, imageDate) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalTitle').textContent = imageTitle;
    document.getElementById('modalDate').innerHTML = '<i class="fas fa-calendar-alt me-1"></i>' + imageDate;
    document.getElementById('imageModalLabel').textContent = 'Detail Galeri';
}

// Handle modal events
document.addEventListener('DOMContentLoaded', function() {
    const imageModal = document.getElementById('imageModal');
    if (imageModal) {
        imageModal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('modalImage').src = '';
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Loading state for pagination
    document.querySelectorAll('.page-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.closest('.page-item').classList.contains('disabled') && 
                !this.closest('.page-item').classList.contains('active')) {
                const originalText = this.innerHTML;
                this.innerHTML = '<span class="loading"></span>';
                
                // Simulate loading (remove this in real implementation)
                setTimeout(() => {
                    this.innerHTML = originalText;
                }, 1000);
            }
        });
    });
});
</script>

@endsection
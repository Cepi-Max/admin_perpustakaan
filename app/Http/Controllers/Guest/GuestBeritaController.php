<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class GuestBeritaController extends Controller
{
    public function index(Request $request)
    {
        // Mengatur pagination untuk menampilkan 7 berita per halaman
        // (1 berita utama + 6 berita di 2 kolom)
        $perPage = $request->input('per_page', 9);

        $berita = Berita::with(['author', 'kategori_berita'])

            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $data = [
            'title' => 'Berita - Perpustakaan',
            'berita' => $berita,
        ];

        return view('pengunjung.berita.index', $data);
    }

    public function show($slug)
    {
        $detailBerita = Berita::with(['author', 'kategori_berita'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $detailBerita->increment('views');

        // Get related articles
        $relatedBerita = Berita::with(['author', 'kategori_berita'])
            ->where('kategori_berita_id', $detailBerita->kategori_berita_id)
            ->where('id', '!=', $detailBerita->id)
            ->latest()
            ->take(3)
            ->get();

        $data = [
            'title' => $detailBerita->title . ' - Perpustakaan',
            'detailBerita' => $detailBerita,
            'relatedBerita' => $relatedBerita,
        ];

        return view('pengunjung.berita.detail', $data);
    }
}

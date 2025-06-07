<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class GuestBeritaController extends Controller
{
    public function index(Request $request)
    {
        // Mengatur pagination untuk menampilkan 9 berita per halaman
        $perPage = $request->input('per_page', 10);

        $query = Berita::with(['author', 'kategori_berita'])
            ->filter($request->only(['search', 'kategori_berita', 'author']));

        // Sorting
        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $berita = $query->paginate($perPage)->withQueryString();

        // (Opsional) Ambil 5 berita dengan view terbanyak sebagai berita populer
        $beritaPopuler = Berita::orderBy('seen', 'desc')
            ->take(3)
            ->get();

        $data = [
            'title' => 'Berita - Perpustakaan',
            'berita' => $berita,
            'beritaPopuler' => $beritaPopuler,
        ];

        return view('pengunjung.berita.index', $data);
    }


    public function show($slug)
    {
        $detailBerita = Berita::with(['author', 'kategori_berita'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $detailBerita->increment('seen');

        // Get related articles
        $relatedBerita = Berita::with(['author', 'kategori_berita'])
            ->where('berita_category_id', $detailBerita->berita_category_id)
            ->where('id', '!=', $detailBerita->id)
            ->latest()
            ->take(3)
            ->get();

        $beritaPopuler = Berita::orderBy('seen', 'desc')
            ->take(3)
            ->get();

        $data = [
            'title' => $detailBerita->title . ' - Perpustakaan',
            'detailBerita' => $detailBerita,
            'relatedBerita' => $relatedBerita,
            'beritaPopuler' => $beritaPopuler,
        ];

        return view('pengunjung.berita.detail', $data);
    }
}

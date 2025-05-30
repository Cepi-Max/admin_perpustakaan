<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Iklan;
use Illuminate\Http\Request;

class GuestBeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(10)->withQueryString();

        $data = [
            'title' => 'Berita-Perpustakaan',
            'berita' => $berita,
        ];
        return  view('pengunjung.berita.index', $data);
    }

    public function show($slug)
    {
        $detailBerita = Berita::where('slug', $slug)->firsOrfail();

        $data = [
            'title' => 'Detail-Berita-Perpustakaan',
            'detailBerita' => $detailBerita,
        ];
        return  view('pengunjung.berita.detail', $data);
    }
}

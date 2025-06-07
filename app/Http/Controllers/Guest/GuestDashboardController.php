<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Iklan;
use Illuminate\Http\Request;

class GuestDashboardController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(6)->withQueryString();
        $galeri = Galeri::latest()->paginate(3)->withQueryString();
        $iklan = Iklan::all();

        $data = [
            'title' => 'Beranda-Perpustakaan',
            'berita' => $berita,
            'galeri' => $galeri,
            'iklan' => $iklan,
        ];
        return  view('pengunjung.dashboard.index', $data);
    }
}

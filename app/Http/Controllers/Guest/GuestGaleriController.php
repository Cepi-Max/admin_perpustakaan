<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GuestGaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(6)->withQueryString();

        $data = [
            'title' => 'Galeri-Perpustakaan',
            'galeri' => $galeri,
        ];
        return  view('pengunjung.galeri.index', $data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Galeri::create([
                'judul' => "Judul Galeri $i",
                'deskripsi' => "Deskripsi singkat untuk galeri ke-$i. Bellissimo!",
                'gambar' => "galeri_$i.jpg", // Pastikan file gambarnya ada kalau dipakai beneran

            ]);
        }
    }
}

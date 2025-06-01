<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\User;
use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil satu user atau buat baru jika belum ada
        $author = User::first() ?? User::factory()->create([
            'name' => 'Admin Seeder',
            'email' => 'admin@seeder.com',
            'password' => bcrypt('password'),
        ]);

        // Ambil satu kategori atau buat jika belum ada
        $kategori = KategoriBerita::first() ?? KategoriBerita::create([
            'nama' => 'Kategori Default',
            'slug' => 'kategori-default',
        ]);

        for ($i = 1; $i <= 20; $i++) {
            $title = "Berita Ke-{$i}: " . fake()->sentence();
            $slug = Str::slug($title) . '-' . $i;

            Berita::create([
                'title' => $title,
                'slug' => $slug,
                'body' => fake()->paragraphs(4, true),
                'image' => '2025-05-31_00-33-36_d1uOVLx1Qz.png',
                'inovator' => fake()->name(),
                'seen' => rand(10, 200),
                'author_id' => $author->id,
                'berita_category_id' => $kategori->id, // ✅ inilah yang error sebelumnya
            ]);
        }
    }
}

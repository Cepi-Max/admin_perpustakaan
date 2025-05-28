<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        // Tangani Slug
        $slug = Str::slug($request->input('name'));
        $existingSlugCount = KategoriBerita::where('slug', 'LIKE', "{$slug}%")->count();

        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }
        
        $articleCategory = new KategoriBerita;
 
        $articleCategory->slug = $slug;
        $articleCategory->name = $request->input('name');
        $articleCategory->color = $request->input('color');

        $articleCategory->save();

        // Dapatkan referer dari header
        $referer = $request->headers->get('referer');

        // Redirect kembali ke referer dengan pesan sukses
        return redirect($referer)->with('success', 'Kategori artikel berhasil ditambahkan.');

    }

    public function delete(Request $request, $slug): RedirectResponse
    {
        try {
            // Cari kategori artikel berdasarkan slug
            $articleCategoryBySlug = KategoriBerita::where('slug', $slug)->firstOrFail();
    
            // Hapus kategori artikel
            $articleCategoryBySlug->delete();
    
            return redirect()->back()->with('success', 'Kategori artikel berhasil dihapus.');
        } catch (QueryException $e) {
            // Jika terjadi error karena constraint foreign key
            return redirect()->back()->with('error', 'Gagal menghapus kategori artikel karena masih digunakan di tabel lain.');
        } catch (\Exception $e) {
            // Menangani error lain
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }
}

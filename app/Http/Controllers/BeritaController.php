<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::filter(request(['search', 'category', 'admin', 'author']))->latest()->paginate(6)->withQueryString();

        $data = [
            'title' => 'Daftar Berita',
            'berita' => $berita
        ];

        return view('admin/berita/index', $data);
    }

    public function beritaForm($slug = null)
    {
        $beritaBySlug = $slug ? Berita::where('slug', $slug)->firstOrFail() : null;
        $categories = KategoriBerita::all();

        $data = [
            'title' => $beritaBySlug ? 'Form Ubah Berita' : 'Form Tambah Berita',
            'categories' => $categories,
            'beritaBySlug' => $beritaBySlug,
        ];

        return view('admin/berita/form', $data);
    }


    public function save(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'kategori_berita_id' => 'required',
            'image' => 'nullable|image|max:2560', // File harus berupa gambar dengan ukuran maksimal 2.5MB
        ], [
            'title.required' => 'Judul harus diisi.',
            'body.required' => 'Isi berita harus diisi.',
            'kategori_berita_id.required' => 'Kategori berita harus diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2,5 MB.',
        ]);

        $slug = Str::slug($request->input('title'));
        $existingSlugCount = Berita::where('slug', 'LIKE', "{$slug}%")->count();

        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }
        
    
         if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image'); 
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path   = 'berita/'.$fileName;
            Storage::disk('public')->put($path, file_get_contents($file));
         } else {
             $fileName = 'default.png';
         }

        $author_id = Auth::id();
        
        $article = new Berita;
 
        $slug = Str::slug($validatedData['title']);
        $existingSlugCount = Berita::where('slug', 'LIKE', "{$slug}%")->count();

        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }
        $article->slug = $slug;

        $article->title = $validatedData['title'];

        $article->body = $request->input('body');
        $article->berita_category_id = $request->input('kategori_berita_id');
        $article->author_id = $author_id;
        $article->seen = 0;
        $article->image = $fileName;

        $article->save();

        return redirect()->route('admin.berita.show')->with('success', 'Data Berhasil Ditambahkan.');
    }


    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'kategori_berita_id' => 'required',
            'image' => 'nullable|image|max:2560', // File harus berupa gambar dengan ukuran maksimal 2.5MB
        ], [
            'title.required' => 'Judul harus diisi.',
            'body.required' => 'Isi berita harus diisi.',
            'kategori_berita_id.required' => 'Kategori berita harus diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2,5 MB.',
        ]);

        
        $articleBySlug = Berita::where('slug', $slug)->firstOrFail();

        $author_id = Auth::id();
 
        $slug = Str::slug($validatedData['title']);
        
        $articleBySlug->slug = $slug;

        $articleBySlug->title = $validatedData['title'];
        
        $articleBySlug->body =  $request->input('body');
        $articleBySlug->berita_category_id = $request->input('kategori_berita_id');
        $articleBySlug->author_id = $author_id;
        $articleBySlug->seen = 0;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');

            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = 'berita/' . $fileName;

            if ($articleBySlug->image && $articleBySlug->image !== 'default.png') {
                Storage::disk('public')->delete('berita/' . $articleBySlug->image);
            }

            // Simpan gambar baru
            Storage::disk('public')->put($path, file_get_contents($file));

            // Simpan nama file baru ke dalam database
            $articleBySlug->image = $fileName;
        } else {
            // Jika tidak ada file baru, gunakan gambar lama atau default.png
            $articleBySlug->image = $articleBySlug->image ?? 'default.png';
        }
 
        $articleBySlug->save();

        return redirect()->route('admin.berita.show')->with('success', 'Berita berhasil diperbarui!');
    }

    public function delete($slug)
    {
        // try {
            $articleBySlug = Berita::where('slug', $slug)->firstOrFail();

            if (!empty($articleBySlug->image) && $articleBySlug->image !== 'default.png') {
                $filePath = 'berita/' . $articleBySlug->image;
                Storage::disk('public')->delete($filePath);
            }

            $articleBySlug->delete();


        return redirect()->route('admin.berita.show')->with('success', 'Berita berhasil dihapus!');
    }

}

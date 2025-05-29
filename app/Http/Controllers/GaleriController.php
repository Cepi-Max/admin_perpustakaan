<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris =  Galeri::latest()->paginate(10);

        $data = [
            'title' => 'Daftar Galeri',
            'galeris' => $galeris
        ];
        return view('admin.galeri.index', $data);
    }

   public function form($id = null)
    {
        $galeri = $id ? Galeri::where('id', $id)->firstOrFail() : null;
        $data = [
            'title' => $galeri ? 'Tambah Galeri' : 'Ubah Galeri',
            'galeri' => $galeri
        ];

        return view('admin.galeri.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => ($id ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png|max:2048',
        ];
        
        $data = $request->validate($rules);

        $galeri = Galeri::findOrFail($id);
        if ($request->hasFile('gambar')) {
            if ($galeri && $galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        if ($galeri) {
            $galeri->update($data);
            $message = 'Gambar berhasil diperbarui.';
        } else {
            Galeri::create($data);
            $message = 'Gambar berhasil ditambahkan.';
        }

        return redirect()->route('admin.galeri.show')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('ids', []);

        $galeris = Galeri::whereIn('id', $ids)->get();

        foreach ($galeris as $galeri) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $galeri->delete();
        }

        return redirect()->route('admin.galeri.show')->with('success', 'Gambar yang dipilih berhasil dihapus.');
    }
}

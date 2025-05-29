<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IklanController extends Controller
{
    //
    public function index()
    {
        $iklans =  Iklan::latest()->paginate(10);

        $data = [
            'title' => 'Daftar Iklan',
            'iklans' => $iklans
        ];
        return view('admin.iklan.index', $data);
    }

   public function form($id = null)
    {
        $iklan = $id ? Iklan::where('id', $id)->firstOrFail() : null;
        $data = [
            'title' => $iklan ? 'Tambah Iklan' : 'Ubah Iklan',
            'iklan' => $iklan
        ];

        return view('admin.iklan.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        $rules = [
            'deskripsi' => 'nullable|string',
            'gambar' => ($id ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png|max:2048',
        ];
        
        $data = $request->validate($rules);

        $iklan = Iklan::findOrFail($id);
        if ($request->hasFile('gambar')) {
            if ($iklan && $iklan->gambar) {
                Storage::disk('public')->delete($iklan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('iklan', 'public');
        }

        if ($iklan) {
            $iklan->update($data);
            $message = 'Iklan berhasil diperbarui.';
        } else {
            Iklan::create($data);
            $message = 'Iklan berhasil ditambahkan.';
        }

        return redirect()->route('admin.iklan.show')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('ids', []);

        $iklans = Iklan::whereIn('id', $ids)->get();

        foreach ($iklans as $iklan) {
            if ($iklan->gambar) {
                Storage::disk('public')->delete($iklan->gambar);
            }
            $iklan->delete();
        }

        return redirect()->route('admin.iklan.show')->with('success', 'Gambar yang dipilih berhasil dihapus.');
    }
}

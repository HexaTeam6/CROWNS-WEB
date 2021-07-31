<?php

namespace App\Http\Controllers\Admin\Katalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Katalog\StoreBajuRequest;
use App\Models\Baju;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function updatePutBaju (StoreBajuRequest $request, $id) {
        $baju = Baju::findOrFail($request->id);

        /* image handler */
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->image;
        $image_name = '';
        if ($image !== null) {
            $image_name = 'foto' . '-' . $id . "." . $image->extension();
            $image_name = str_replace(' ', '-', strtolower($image_name));
            Storage::delete($baju->foto);
            $image->storeAs('public', $image_name);
        }

        /* common data */
        $baju->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'deskripsi' => $request->deskripsi,
            'foto' => asset('storage') . '/' . $image_name
        ]);
        
        return redirect()->back()->with('success', 'berhasil diedit');
    }

    public function updatePutKategori (Request $request, $id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama
        ]);
        return redirect()->back()->with('success', 'berhasil diedit');
    }
}

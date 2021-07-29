<?php

namespace App\Http\Controllers\Admin\Katalog;

use App\Http\Controllers\Controller;
use App\Models\Baju;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function createKategori() {
        return view('catalogue.kategori.create');
    }

    public function createBaju() {
        $list_kategori = Kategori::all();
        return view('catalogue.baju.create', compact(['list_kategori']));
    }

    public function storeKategori(Request $request) {
        Kategori::create([
            'nama' => $request->nama
        ]);
        return redirect()->back()->with('success', 'berhasil ditambahkan');
    }

    public function storeBaju(Request $request) {
        $baju = Baju::create([
            'id_kategori' => $request->id_kategori,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'deskripsi' => $request->deskripsi,
        ]);
        $baju->update([
            'foto' => $this->storeImage($request, $baju->id)
        ]);
        return redirect()->back()->with('success', 'berhasil ditambahkan');
    }

    /* image handler */
    public function storeImage(Request $request, $id)
    {
        $image = $request->image;
        $image_name = '';
        if ($image !== null) {
            $image_name = 'foto' . '-' . $id . "." . $image->extension();
            $image_name = str_replace(' ', '-', strtolower($image_name));
            $image->storeAs('images', $image_name);
            $image->move(public_path() . '\\storage\\', $image_name);
        }

        return asset('\\storage\\') . $image_name;
    }
}

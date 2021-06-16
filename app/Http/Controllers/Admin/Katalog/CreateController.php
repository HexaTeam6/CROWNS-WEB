<?php

namespace App\Http\Controllers\Admin\Katalog;

use App\Http\Controllers\Controller;
use App\Models\Baju;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function storeKategori(Request $request) {
        Kategori::create([
            'nama' => $request->nama
        ]);
        return redirect()->back();
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
        return redirect()->back();
    }

    public function storeImage(Request $request, $id)
    {
        $image = $request->image;

        $image_name = 'foto' . '-' . $id . $request->image->extension();
        $image_name = str_replace(' ', '-', strtolower($image_name));
        $image->storeAs('images', $image_name);
        $image->move(public_path() . '/gallery/images', $image_name);

        return $image_name;
    }
}

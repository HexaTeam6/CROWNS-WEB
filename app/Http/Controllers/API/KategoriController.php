<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends APIController
{
    // fungsi untuk mengambil list kategori
    public function index()
    {
        $response = Kategori::all();

        return $this->sendResponse($response, 'List semua kategori berhasil diambil');
    }

    // fungsi untuk mengambil list katalog berdasarkan kategori
    public function katalogByKategori(Request $request)
    {
        $kategori = Kategori::find($request->id);

        if(!$kategori) {
            return $this->sendError("Kategori tidak ditemukan");
        }

        $response['kategori'] = $kategori['nama'];
        $response['katalog'] = $kategori->baju;

        return $this->sendResponse($response, 'List katalog berdasarkan kategori berhasil diambil');
    }
}

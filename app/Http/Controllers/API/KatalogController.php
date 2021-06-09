<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Baju;
use Illuminate\Http\Request;

class KatalogController extends ApiController
{
    // Fungsi untuk mengambil list semua katalog
    public function index()
    {
        $response = Baju::all();

        return $this->sendResponse($response, 'List semua katalog berhasil diambil');
    }

    // Fungsi untuk mengambil list penjahit berdasar katalog
    public function penjahitByKatalog(Request $request)
    {
        $katalog = Baju::find($request->id);

        if(!$katalog) {
            return $this->sendError("Katalog tidak ditemukan");
        }

        $response['katalog'] = $katalog['nama'];
        $response['penjahit'] = $katalog->penjahit;

        return $this->sendResponse($response, 'List penjahit berdasarkan katalog berhasil diambil');
    }
}

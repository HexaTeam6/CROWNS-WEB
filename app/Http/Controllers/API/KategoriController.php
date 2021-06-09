<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends APIController
{
    // fungsi untuk mengambil list kategori
    public function index(Request $request)
    {
        $response = Kategori::all();

        return $this->sendResponse($response, 'List semua kategori berhasil diambil');
    }
}

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
}

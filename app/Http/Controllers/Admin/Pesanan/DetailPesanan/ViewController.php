<?php

namespace App\Http\Controllers\Admin\Pesanan\DetailPesanan;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function getAll() {
        return DetailPesanan::all();
    }
    
    public function getDetailPesanan($id) {
        return DetailPesanan::where('id_pesanan', $id)->first();
    }
}

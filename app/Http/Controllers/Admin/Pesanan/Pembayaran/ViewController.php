<?php

namespace App\Http\Controllers\Admin\Pesanan\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function getPembayaran($id) {
        return Pembayaran::where('id_pesanan', $id)->first();
    }
}

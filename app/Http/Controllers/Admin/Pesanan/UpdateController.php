<?php

namespace App\Http\Controllers\Admin\Pesanan;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function validasi(Request $request) {
        $pesanan = Pesanan::findOrFail($request->id);
        $pesanan->pembayaran->update(['status_pembayaran' => $request->validasi]);
        return redirect()->back()->with('success', 'berhasil memvalidasi');
    }
}

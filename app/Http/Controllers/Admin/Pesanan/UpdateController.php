<?php

namespace App\Http\Controllers\Admin\Pesanan;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UpdateController extends Controller
{
    public function validasi(Request $request) {
        $pesanan = Pesanan::findOrFail($request->id);
        $pesanan->pembayaran->update(['status_pembayaran' => $request->validasi]);
        $pesanan->update(['updated_at' => Carbon::now()]);
        return redirect()->back()->with('success', 'berhasil memvalidasi');
    }
}

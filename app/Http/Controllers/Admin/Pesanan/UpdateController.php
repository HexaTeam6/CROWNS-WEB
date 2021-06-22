<?php

namespace App\Http\Controllers\Admin\Pesanan;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function validasi(Request $request) {
        $pesanan = Pesanan::findOrFail($request->id);
        $pesanan->update(['status_pesanan' => 'S']);
        return redirect()->back()->with('success', 'berhasil memvalidasi');
    }
}

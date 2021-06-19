<?php

namespace App\Http\Controllers\Admin\Pesanan;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function view() {
        $list_pesanan = Pesanan::all();
        return view('pesanan.index', compact('list_pesanan'));
    }
}

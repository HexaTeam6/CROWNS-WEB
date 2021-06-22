<?php

namespace App\Http\Controllers\Admin\Pesanan;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Pesanan\Pembayaran\ViewController as PembayaranViewController;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    private $pembayaran_view_controller;
    
    public function __construct(PembayaranViewController $pembayaran_view_controller) {
        $this->pembayaran_view_controller = $pembayaran_view_controller;
    }

    public function view() {
        $list_pesanan = Pesanan::all();
        return view('pesanan.index', compact('list_pesanan'));
    }

    public function viewPembayaran($id) {
        $pembayaran = $this->pembayaran_view_controller->getPembayaran($id);
        return view('pesanan.detail', compact('pembayaran'));
    }
}

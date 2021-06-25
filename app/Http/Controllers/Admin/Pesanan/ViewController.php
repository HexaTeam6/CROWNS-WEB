<?php

namespace App\Http\Controllers\Admin\Pesanan;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Pesanan\Pembayaran\ViewController as PembayaranViewController;
use App\Http\Controllers\Admin\Pesanan\UtilityController as PesananUtilityController;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    private $pembayaran_view_controller;
    private $utility_controller;
    
    public function __construct(
        PembayaranViewController $pembayaran_view_controller,
        PesananUtilityController $utility_controller
        ) {
        $this->utility_controller = $utility_controller;
        $this->pembayaran_view_controller = $pembayaran_view_controller;
    }

    public function view() {
        $list_pesanan = Pesanan::all()->sortBy('created_at');
        $list_belum = $this->utility_controller->getPesananBelumDivalidasi();
        $list_diterima = $this->utility_controller->getPesananDiterima();
        $list_ditolak = $this->utility_controller->getPesananDitolak();
        return view('pesanan.index', compact(['list_diterima', 'list_belum', 'list_ditolak']));
    }

    public function viewPembayaran(int $id) {
        $pembayaran = $this->pembayaran_view_controller->getPembayaran($id);
        return view('pesanan.detail', compact('pembayaran'));
    }

    
}
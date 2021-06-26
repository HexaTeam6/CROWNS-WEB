<?php

namespace App\Http\Controllers\Admin\Pesanan;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Builder;

class UtilityController extends Controller
{
    public function getPesananDiterima () {
        $list_pesanan = Pesanan::whereHas('pembayaran', function (Builder $query) {
                $query->where('status_pembayaran', '=', '4');
            })
            ->get()
            ->sortBy([
                ['updated_at', 'desc'],
                ['created_at', 'asc'],
            ]);

        return $list_pesanan;
    }

    public function getPesananBelumDivalidasi () {
        $list_pesanan = Pesanan::whereHas('pembayaran', function (Builder $query) {
                $query->where('status_pembayaran', '=', '3');
            })
            ->get()
            ->sortBy([
                ['updated_at', 'desc'],
                ['created_at', 'asc'],
            ]);

        return $list_pesanan;
    }

    public function getPesananDitolak () {
        $list_pesanan = Pesanan::whereHas('pembayaran', function (Builder $query) {
                $query->where('status_pembayaran', '=', '2');
            })
            ->get()
            ->sortBy([
                ['updated_at', 'desc'],
                ['created_at', 'asc'],
            ]);

        return $list_pesanan;
    }
}

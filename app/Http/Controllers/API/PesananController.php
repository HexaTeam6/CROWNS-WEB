<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PesananResource;
use App\Models\Pesanan;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as DBCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesananController extends APIController
{
    // fungsi untuk mengambil pesanan
    // berdasarkan id pesanan
    public function pesananById(Request $request)
    {
        $pesanan = Pesanan::find($request->id_pesanan);

        if(!$pesanan) {
            return $this->sendError('Pesanan tidak ditemukan');
        } else {
            return $this->sendResponse(new PesananResource($pesanan), 'Pesanan berhasil diambil');
        }
    }

    // fungsi untuk mengambil list pesanan
    // yang pembayarannya sudah divalidasi admin
    public function pembayaranValid(Request $request)
    {
        $user = $request->user();

        if ($user->role == 'pembeli') {
            $user = $user->konsumen;
        } else if ($user->role == 'penjahit') {
            $user = $user->penjahit;
        }

        $pesanan = $user->pesanan()->where('status_pesanan', 4)
            ->whereHas('pembayaran', function (Builder $query) {
                $query->where('status_pembayaran', 4);
            })->latest()->get();

        return $this->sendResponse(PesananResource::collection($pesanan), 'Pesanan yang pembayarannya valid berhasil diambil');
    }

    // fungsi untuk mengambil list pesanan
    // yang belum memulai pembayaran
    // atau pembayarannya belum valid
    public function pembayaranBelumValid(Request $request)
    {
        $user = $request->user();

        if ($user->role == 'pembeli') {
            $user = $user->konsumen;
        } else if ($user->role == 'penjahit') {
            $user = $user->penjahit;
        }

        $pesanan = $user->pesanan()->where('status_pesanan', 4)
                    ->whereHas('pembayaran', function (Builder $query2) {
                        $query2->where('status_pembayaran', '<>', 4);
                    })->orWhere('status_pesanan', 3)->latest()->get();

        $pesanan = $this->getPhoto($pesanan);

        return $this->sendResponse(PesananResource::collection($pesanan), 'Pesanan yang pembayarannya belum valid berhasil diambil');
    }

    /**
     * attach photo to the data / pesanan
     */
    public function getPhoto(DBCollection $pesanan): DBCollection {
        try{
            foreach($pesanan as $unit){
                foreach($unit->designKustom as $designKustom) {
                    $foto = file_get_contents(public_path('\\gallery\\images\\' . $designKustom->foto));
                    $foto = base64_encode($foto);
                    $designKustom->foto = $foto;
                }
            }
            return $pesanan;
        } catch (Exception $e) {
            return $pesanan;
        }
    }
}

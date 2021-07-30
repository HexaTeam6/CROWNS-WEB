<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Penjahit;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PesananPenjahitController extends APIController
{
        // fungsi untuk penjual mengisi harga
        public function updateHarga(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'id_pesanan' => 'required|exists:pesanan,id',
                'biaya_jahit' => 'required|numeric',
                'biaya_material' => 'required|numeric',
                'biaya_kirim' => 'numeric',
                'biaya_jemput' => 'numeric',
                'hari' => 'required|date',
            ]);
    
            if ($validator->fails()) {
                return $this->sendError('Validasi gagal', $validator->errors(), 400);
            }
    
            $penjahit = Penjahit::where('id_user', $request->user()->id)->first();
            $pesanan = Pesanan::find($request->id_pesanan);
    
            if ($pesanan->id_penjahit != $penjahit->id || $pesanan->status_pesanan != 3) {
                return $this->sendError('Pesanan tidak ditemukan');
            }
    
            DB::beginTransaction();
    
            try {
                $input = $request->except('id_pesanan', 'hari');
                $biaya_total = array_sum($input);
                $input['status_pembayaran'] = 2;
    
                $pesanan->pembayaran()->update($input);
    
                $pesanan->update([
                    'biaya_total' => $biaya_total
                ]);
    
                $pesanan->tawar()->create([
                    'hari_tawar' => Carbon::parse($request->hari)->format('Y-m-d'),
                    'jumlah_penawaran' => $biaya_total,
                    'status_penawaran' => 1,
                ]);
    
            } catch (\Exception $e) {
                DB::rollback();
                return $this->sendError('Pengisian harga gagal',  $e->getMessage(), 500);
            }
    
            DB::commit();
    
            $response['pembayaran'] = $pesanan->pembayaran;
            $response['penawaran'] = $pesanan->tawar;
    
            return $this->sendResponse($response, 'Pengisian harga berhasil');
        }

        // fungsi untuk penjual menerima penawaran
    public function terimaTawar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $penjahit = Penjahit::where('id_user', $request->user()->id)->first();
        $pesanan = Pesanan::find($request->id_pesanan);

        if ($pesanan->id_penjahit != $penjahit->id || $pesanan->status_pesanan != 3) {
            return $this->sendError('Pesanan tidak ditemukan');
        }

        $tawaran = $pesanan->tawar;

        if(!$tawaran || $tawaran->status_penawaran != 2) {
            return $this->sendError('Penawaran tidak ditemukan');
        }

        DB::beginTransaction();

        try {
            $tawaran->update([
                'status_penawaran' => 3
            ]);

            $pesanan->update([
                'biaya_total' => $tawaran->jumlah_penawaran
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError('Menerima penawaran gagal',  $e->getMessage(), 500);
        }

        DB::commit();

        return $this->sendResponse($tawaran, 'Menerima penawaran berhasil');
    }

    // fungsi untuk penjual menolak penawaran
    public function tolakTawar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $penjahit = Penjahit::where('id_user', $request->user()->id)->first();
        $pesanan = Pesanan::find($request->id_pesanan);

        if ($pesanan->id_penjahit != $penjahit->id || $pesanan->status_pesanan != 3) {
            return $this->sendError('Pesanan tidak ditemukan');
        }

        $tawaran = $pesanan->tawar;

        if(!$tawaran || $tawaran->status_penawaran != 2) {
            return $this->sendError('Penawaran tidak ditemukan');
        }

        $tawaran->update([
            'status_penawaran' => 1
        ]);

        return $this->sendResponse($tawaran, 'Menolak penawaran berhasil');
    }

}

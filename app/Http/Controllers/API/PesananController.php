<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Penjahit;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PesananController extends APIController
{
    // fungsi untuk pembeli membuat data pesanan kosong
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_penjahit' => 'required|exists:penjahit,id',
            'id_baju' => 'required|exists:baju,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $konsumen = Konsumen::where('id_user', $request->user()->id)->first();
        $pesanan = $konsumen->pesanan()->create([
            'id_penjahit' => $request->id_penjahit,
            'id_konsumen' => $konsumen->id,
            'id_baju' => $request->id_baju,
            'status_pesanan' => 1
        ]);

        if ($pesanan) {
            return $this->sendResponse($pesanan, 'Pesanan berhasil dibuat');
        } else {
            return $this->sendError('Create gagal', 500);
        }
    }

    // fungsi untuk pembeli mengisi detail pesanan
    public function updateDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id',
            'jumlah' => 'required|integer|min:1',
            'list_detail' => 'required|array',
            'list_detail.*.nama_lengkap' => 'required',
            'list_detail.*.lengan' => 'required|numeric',
            'list_detail.*.pinggang' => 'required|numeric',
            'list_detail.*.dada' => 'required|numeric',
            'list_detail.*.leher' => 'required|numeric',
            'list_detail.*.tinggi_tubuh' => 'required|numeric',
            'list_detail.*.berat_badan' => 'required|numeric',
            'list_detail.*.instruksi_pembuatan' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $konsumen = Konsumen::where('id_user', $request->user()->id)->first();
        $pesanan = Pesanan::find($request->id_pesanan);

        if ($pesanan->id_konsumen != $konsumen->id || $pesanan->status_pesanan != 1) {
            return $this->sendError('Pesanan tidak ditemukan');
        }

        DB::beginTransaction();

        try {
            $pesanan->detailPesanan()->createMany($request->list_detail);

            $pesanan->update([
                'jumlah' => $request->jumlah,
                'status_pesanan' => 2
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError('Update gagal',  $e->getMessage(), 500);
        }

        DB::commit();

        return $this->sendResponse($pesanan->detailPesanan()->get(), 'Detail pesanan berhasil ditambahkan');
    }

    // fungsi untuk pembeli mengupload design kustom
    public function uploadDesignCustom(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id',
            'list_foto' => 'required|array',
            'list_foto.*.foto' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $konsumen = Konsumen::where('id_user', $request->user()->id)->first();
        $pesanan = Pesanan::find($request->id_pesanan);

        if ($pesanan->id_konsumen != $konsumen->id) {
            return $this->sendError('Pesanan tidak ditemukan');
        }

        DB::beginTransaction();

        try {
            foreach ($request->list_foto as $foto) {
                $image_64 = $foto['foto'];

                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);

                do {
                    $imageName = 'designCustom/'.Str::random(10) . '.' . $extension;
                } while (Storage::disk('public')->exists($imageName));

                Storage::disk('public')->put($imageName, base64_decode($image));

                $pesanan->designKustom()->create([
                    'foto' => asset('storage/'.$imageName),
                    'deskripsi' => isset($foto['deskripsi']) ? $foto['deskripsi'] : NULL
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError('Upload foto gagal',  $e->getMessage(), 500);
        }

        DB::commit();

        return $this->sendResponse($pesanan->designKustom()->get(), 'Design kustom berhasil ditambahkan');
    }

    // fungsi untuk pembeli memilih pesanan dijemput atau tidak
    // dan mengisi alamat penjemputan apabila dijemput
    public function updateJemput(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id',
            'dijemput' => 'required|in:0,1',
            'kode_pos' => 'required_if:dijemput,1|numeric',
            'kecamatan' => 'required_if:dijemput,1',
            'kota' => 'required_if:dijemput,1',
            'alamat' => 'required_if:dijemput,1',
            'waktu' => 'required_if:dijemput,1|date'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $konsumen = Konsumen::where('id_user', $request->user()->id)->first();
        $pesanan = Pesanan::find($request->id_pesanan);

        if ($pesanan->id_konsumen != $konsumen->id || $pesanan->status_pesanan != 2) {
            return $this->sendError('Pesanan tidak ditemukan');
        }

        DB::beginTransaction();

        try {

            if ($request->dijemput == 1) {
                $input = $request->except('id_pesanan', 'dijemput');
                $input['waktu'] = Carbon::parse($input['waktu'])->format('Y-m-d H:i:s');
                $pesanan->lokasiPenjemputan()->create($input);
            }

            $pesanan->update([
                'status_pesanan' => 3
            ]);

            $pesanan->pembayaran()->create([
                'status_pembayaran' => 1
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError('Update alamat penjemputan gagal',  $e->getMessage(), 500);
        }

        DB::commit();

        $response['pembayaran'] = $pesanan->pembayaran;

        if ($request->dijemput == 1) {
            $response['alamat_jemput'] = $pesanan->lokasiPenjemputan;
        }

        return $this->sendResponse($response, 'Update alamat penjemputan berhasil');
    }

    // fungsi untuk penjual mengisi harga
    public function updateHarga(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id',
            'biaya_jahit' => 'required|numeric',
            'biaya_material' => 'required|numeric',
            'biaya_kirim' => 'numeric',
            'biaya_jemput' => 'numeric',
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
            $input = $request->except('id_pesanan');
            $biaya_total = array_sum($input);
            $input['status_pembayaran'] = 2;

            $pesanan->pembayaran()->update($input);

            $pesanan->update([
                'biaya_total' => $biaya_total
            ]);

            $pesanan->tawar()->create([
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

    // fungsi untuk pembeli mengajukan penawaran
    public function ajukanTawar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id',
            'hari_tawar' => 'required|date',
            'jumlah_penawaran' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $konsumen = Konsumen::where('id_user', $request->user()->id)->first();
        $pesanan = Pesanan::find($request->id_pesanan);

        if ($pesanan->id_konsumen != $konsumen->id || $pesanan->status_pesanan != 3) {
            return $this->sendError('Pesanan tidak ditemukan');
        }

        $tawaran = $pesanan->tawar;

        if(!$tawaran || $tawaran->status_penawaran != 1) {
            return $this->sendError('Penawaran tidak ditemukan');
        }

        $tawaran->update([
            'hari_tawar' => Carbon::parse($request->hari_tawar)->format('Y-m-d'),
            'jumlah_penawaran' => $request->jumlah_penawaran,
            'status_penawaran' => 2
        ]);

        return $this->sendResponse($tawaran, 'Pengajuan penawaran berhasil');
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
<?php

namespace App\Http\Controllers\API;

use App\Models\Konsumen;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PesananPembeliController extends APIController
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

    // fungsi untuk pembeli memilih metode pembayaran
    // dan mengupload bukti pembayaran
    public function bayar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id',
            'metode_pembayaran' => 'required',
            'list_bukti' => 'required|array',
            'list_bukti.*.foto' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $konsumen = Konsumen::where('id_user', $request->user()->id)->first();
        $pesanan = Pesanan::find($request->id_pesanan);

        if ($pesanan->id_konsumen != $konsumen->id) {
            return $this->sendError('Pesanan tidak ditemukan');
        }

        $pembayaran = $pesanan->pembayaran;

        if (!$pembayaran || $pembayaran->status_pembayaran != 2) {
            return $this->sendError('Pembayaran tidak ditemukan');
        }

        $listBukti = array();

        DB::beginTransaction();

        try {
            foreach ($request->list_bukti as $bukti) {
                $image_64 = $bukti['foto'];

                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);

                do {
                    $imageName = 'buktiPembayaran/'.Str::random(10) . '.' . $extension;
                } while (Storage::disk('public')->exists($imageName));

                Storage::disk('public')->put($imageName, base64_decode($image));

                $bukti = $pembayaran->buktiPembayaran()->create([
                    'foto' => asset('storage/'.$imageName)
                ]);

                array_push($listBukti, $bukti);

                $pembayaran->update([
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'status_pembayaran' => 3
                ]);

                $pesanan->update([
                    'status_pesanan' => 4
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError('Upload bukti pembayaran gagal',  $e->getMessage(), 500);
        }

        DB::commit();

        return $this->sendResponse($listBukti, 'Upload bukti pembayaran berhasil');
    }

    // fungsi untuk pembeli memberikan rating ke pesanan
    public function rate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pesanan' => 'required|exists:pesanan,id',
            'rating' => 'required|numeric|between:1,5',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi gagal', $validator->errors(), 400);
        }

        $konsumen = Konsumen::where('id_user', $request->user()->id)->first();
        $pesanan = Pesanan::find($request->id_pesanan);

        if ($pesanan->id_konsumen != $konsumen->id || $pesanan->status_pesanan != 5 || $pesanan->rating != NULL) {
            return $this->sendError('Pesanan tidak ditemukan');
        }

        $pesanan->update([
            'rating' => $request->rating
        ]);

        return $this->sendResponse($pesanan, 'Memberikan rating berhasil');
    }
}
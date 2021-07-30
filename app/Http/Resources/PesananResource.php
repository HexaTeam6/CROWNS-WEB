<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PesananResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_penjahit' => $this->id_penjahit,
            'id_konsumen' => $this->id_konsumen,
            'baju' => $this->baju,
            'jumlah' => $this->jumlah,
            'biaya_total' => $this->biaya_total,
            'status_pesanan' => $this->status_pesanan,
            'rating' => $this->rating,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
            'detail_pesanan' => $this->detailPesanan,
            'designKustom' => $this->designKustom,
            'lokasi_penjemputan' => $this->lokasiPenjemputan,
            'pembayaran' => $this->pembayaran,
            'penawaran' => $this->tawar
        ];
    }
}

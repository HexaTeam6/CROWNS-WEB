<?php

namespace App\Http\Resources;

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
            'id_baju' => $this->id_baju,
            'jumlah' => $this->jumlah,
            'biaya_total' => $this->biaya_total,
            'status_pesansn' => $this->status_pesansn,
            'rating' => $this->rating,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'detail_pesanan' => $this->detailPesanan,
            'designKustom' => $this->designKustom,
            'lokasi_penjemputan' => $this->lokasiPenjemputan,
            'pembayaran' => $this->pembayaran
        ];
    }
}

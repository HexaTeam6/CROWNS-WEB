<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $fillable = [
        'id_penjahit',
        'id_konsumen',
        'id_baju',
        'jumlah',
        'biaya_total',
        'status_pesanan',
        'rating',
        'kain_sendiri',
        'created_at',
        'updated_at'
    ];
    
    public function pembeli()
    {
        return $this->belongsTo(Konsumen::class, 'id_konsumen');
    }

    public function penjahit()
    {
        return $this->belongsTo(Penjahit::class, 'id_penjahit');
    }

    public function baju()
    {
        return $this->belongsTo(Baju::class, 'id_baju');
    }
    
    public function lokasiPenjemputan()
    {
        return $this->hasMany(LokasiPenjemputan::class, 'id_pesanan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pesanan');
    }
    
    public function designKustom()
    {
        return $this->hasMany(DesignKostum::class, 'id_pesanan');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }

    public function tawar()
    {
        return $this->hasOne(Tawar::class, 'id_pesanan');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

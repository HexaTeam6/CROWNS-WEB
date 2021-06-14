<?php

namespace App\Models;

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
        'created_at',
        'updated_at'
    ];



    public function designKustom()
    {
        return $this->hasMany(DesignKostum::class, 'id_pesanan');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }

    public function pembeli()
    {
        return $this->belongsTo(Konsumen::class, 'id_konsumen');
    }

    public function penjahit()
    {
        return $this->belongsTo(Penjahit::class, 'id_penjahit');
    }
}

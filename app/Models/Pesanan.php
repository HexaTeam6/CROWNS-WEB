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
        'id_design_kostum',
        'jumlah',
        'biaya_total',
        'status_pesanan',
        'created_at',
        'updated_at'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}

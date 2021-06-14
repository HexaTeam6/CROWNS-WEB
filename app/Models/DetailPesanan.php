<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;
    protected $table = 'detail_pesanan';
    public $timestamps = false;
    
    protected $fillable = [
        'id_pesanan',
        'nama_lengkap',
        'lengan',
        'pinggang',
        'dada',
        'leher',
        'tinggi_tubuh',
        'berat_badan',
        'instruksi_pembuatan'
    ];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
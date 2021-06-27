<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPenjemputan extends Model
{
    use HasFactory;
    protected $table = 'lokasi_penjemputan';

    protected $fillable = [
        'kode_pos',
        'kecamatan',
        'kota',
        'provinsi',
        'alamat',
        'waktu',
        'instruksi'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}

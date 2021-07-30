<?php

namespace App\Models;

use DateTimeInterface;
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
        'instruksi',
        'tipe'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

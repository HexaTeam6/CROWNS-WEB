<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';

    protected $fillable = [
        'biaya_jahit',
        'biaya_material',
        'biaya_kirim',
        'biaya_jemput',
        'status_pembayaran',
        'metode_pembayaran'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    public function buktiPembayaran()
    {
        return $this->hasMany(BuktiPembayaran::class, 'id_pembayaran');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

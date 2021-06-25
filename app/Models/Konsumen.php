<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;
    protected $table = 'konsumen';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'tanggal_lahir',
        'kodepos',
        'kecamatan',
        'kota',
        'provinsi',
        'alamat'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_konsumen');
    }
}

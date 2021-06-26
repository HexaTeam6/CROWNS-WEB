<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjahit extends Model
{
    use HasFactory;
    protected $table = 'penjahit';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'tanggal_lahir',
        'nama_rek',
        'no_rekening',
        'bank',
        'kodepos',
        'kecamatan',
        'kota',
        'provinsi',
        'alamat'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function baju()
    {
        return $this->belongsToMany(Baju::class, 'memiliki_katalog', 'id_penjahit', 'id_baju')->as('memiliki_table')->withTimestamps();
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_penjahit');
    }
}

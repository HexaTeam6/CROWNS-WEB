<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjahit extends Model
{
    use HasFactory;
    protected $table = 'penjahit';
    protected $fillable = [
        'id_user',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'tanggal_lahir',
        'no_rekening',
        'bank',
        'kodepos',
        'kecamatan',
        'kota/kabupaten',
        'alamat'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}

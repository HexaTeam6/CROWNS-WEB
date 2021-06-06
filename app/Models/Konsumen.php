<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;
    protected $table = 'konsumen';
    protected $fillable = [
        'id_user',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'tanggal_lahir',
        'kodepos',
        'kecamatan',
        'kota/kabupaten',
        'alamat'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}

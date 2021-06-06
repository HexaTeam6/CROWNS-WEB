<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baju extends Model
{
    use HasFactory;
    protected $table = 'baju';
    protected $fillable = [
        'id_kategori',
        'nama',
        'jenis_kelamin',
        'deskripsi',
        'foto'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function pesanan() {
        return $this->hasMany(Pesanan::class, 'id_baju');
    }
}

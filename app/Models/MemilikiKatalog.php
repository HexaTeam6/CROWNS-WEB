<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemilikiKatalog extends Model
{
    use HasFactory;
    protected $table = 'memiliki_katalog';
    protected $fillable = [
        'id_penjahit', 
        'id_baju'
    ];

    public function penjahit() {
        return $this->belongsTo(Penjahit::class, 'id_admin');
    }

    public function baju() {
        return $this->belongsTo(Baju::class, 'id_baju');
    }
}

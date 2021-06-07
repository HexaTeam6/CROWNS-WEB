<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamBuka extends Model
{
    use HasFactory;
    protected $table = 'jam_buka';
    public $timestamps = false;
    
    protected $fillable = [
        'id_penjahit',
        'hari',
        'jam_buka',
        'jam_tutup'
    ];

    public function penjahit() {
        return $this->belongsTo(Penjahit::class, 'id_penjahit');
    }
}

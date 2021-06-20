<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tawar extends Model
{
    use HasFactory;
    protected $table = 'tawar';

    protected $fillable = [
        'hari_tawar',
        'jumlah_penawaran',
        'status_penawaran',
        'created_at',
        'update_at'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}

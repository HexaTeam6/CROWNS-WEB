<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignKostum extends Model
{
    use HasFactory;
    protected $table = 'design_kostum';
    protected $fillable = [
        'foto', 
        'deskripsi'
    ];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, 'id_design_kostum');
    }
}

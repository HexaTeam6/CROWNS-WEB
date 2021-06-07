<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    public $timestamps = false;

    protected $fillable = [
        'nama'
    ];
    
    public function baju() {
        return $this->hasMany(Baju::class, 'id_kategori');
    }
}

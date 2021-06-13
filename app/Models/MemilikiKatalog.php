<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemilikiKatalog extends Model
{
    use HasFactory;
    protected $table = 'memiliki_katalog';
    protected $fillable = ['id_penjahit, id_baju'];
}

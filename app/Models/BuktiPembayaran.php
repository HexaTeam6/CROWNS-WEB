<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    use HasFactory;
    protected $table = 'bukti_pembayaran';
    protected $fillable = ['foto', 'status_bukti_pembayaran'];

    public function pembayaran() {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}

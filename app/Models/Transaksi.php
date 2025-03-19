<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'penyewa_id',
        'kamar_id',
        'check_in',
        'check_out',
        'total_price',
        'transfer_photo',
        'status',
        'komentar',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }

    public function kamar()
    {
        return $this->belongsTo(KamarKos::class);
    }
}

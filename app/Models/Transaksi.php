<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'penyewa_id',
        'kamar_id',
        'check_in',
        'total_price',
        'transfer_photo',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarKos extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'available'
    ];
}

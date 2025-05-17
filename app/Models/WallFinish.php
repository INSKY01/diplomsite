<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WallFinish extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];
} 
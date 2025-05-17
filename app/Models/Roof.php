<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roof extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];
} 
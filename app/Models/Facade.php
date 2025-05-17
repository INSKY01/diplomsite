<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facade extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];
} 
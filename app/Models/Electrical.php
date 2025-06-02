<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Electrical extends Model
{
    protected $table = 'electricals';

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'sockets',
        'switches',
        'lights'
    ];
} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_type_id',
        'area',
        'floor_id',
        'roof_id',
        'material_id',
        'foundation_id',
        'facade_id',
        'electrical_id',
        'wall_finish_id',
        'additions',
        'name',
        'phone',
        'email',
        'comment',
        'total_price',
        'status'
    ];

    protected $casts = [
        'area' => 'float',
        'total_price' => 'float',
        'additions' => 'array',
    ];
} 
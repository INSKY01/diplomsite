<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово назначать.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    /**
     * Атрибуты, которые должны быть приведены к нативным типам.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
    ];

    /**
     * Типы домов, совместимые с данным материалом
     */
    public function houseTypes()
    {
        return $this->belongsToMany(HouseType::class, 'house_type_material');
    }
} 
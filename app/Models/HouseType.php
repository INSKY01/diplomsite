<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];

    /**
     * Материалы, совместимые с данным типом дома
     */
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'house_type_material')
                    ->orderByRaw("CASE WHEN name = 'Другое' THEN 1 ELSE 0 END, id");
    }
} 
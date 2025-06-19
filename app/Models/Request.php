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

    // Связи с другими моделями
    public function houseType()
    {
        return $this->belongsTo(HouseType::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function roof()
    {
        return $this->belongsTo(Roof::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function foundation()
    {
        return $this->belongsTo(Foundation::class);
    }

    public function facade()
    {
        return $this->belongsTo(Facade::class);
    }

    public function electrical()
    {
        return $this->belongsTo(Electrical::class);
    }

    public function wallFinish()
    {
        return $this->belongsTo(WallFinish::class);
    }

    // Получить названия дополнений
    public function getAdditionsNamesAttribute()
    {
        if (empty($this->additions)) {
            return '';
        }
        
        $additions = Addition::whereIn('id', $this->additions)->pluck('name')->toArray();
        return implode(', ', $additions);
    }

    // Получить статус на русском языке
    public function getStatusTextAttribute()
    {
        $statuses = [
            'new' => 'Новая',
            'in_progress' => 'В работе',
            'completed' => 'Завершена',
            'cancelled' => 'Отменена'
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    // Получить цвет статуса для отображения
    public function getStatusColorAttribute()
    {
        $colors = [
            'new' => 'primary',
            'in_progress' => 'warning',
            'completed' => 'success',
            'cancelled' => 'danger'
        ];
        
        return $colors[$this->status] ?? 'secondary';
    }
} 
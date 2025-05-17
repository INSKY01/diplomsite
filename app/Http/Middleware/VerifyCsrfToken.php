<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Исключаем все маршруты API и категорий из проверки CSRF
        'api/*',
        'floors*',
        'roofs*',
        'materials*',
        'foundations*',
        'facades*',
        'electrical*',
        'wall-finishes*',
        'additions*',
    ];
} 
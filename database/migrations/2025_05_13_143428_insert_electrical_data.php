<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Очищаем таблицу перед вставкой
        DB::table('electrical')->truncate();
        
        // Добавляем новые данные
        DB::table('electrical')->insert([
            [
                'name' => 'Базовая электрика',
                'description' => 'Простая электропроводка с минимальным количеством точек',
                'price' => 800,
                'sockets' => 10,
                'switches' => 5,
                'lights' => 8,
                'image' => 'img/electrical1.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Стандарт',
                'description' => 'Стандартная электропроводка с оптимальным количеством розеток и выключателей',
                'price' => 1200,
                'sockets' => 15,
                'switches' => 8,
                'lights' => 12,
                'image' => 'img/electrical2.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Комфорт',
                'description' => 'Расширенная электрика с дополнительными точками и встроенной защитой',
                'price' => 1800,
                'sockets' => 20,
                'switches' => 12,
                'lights' => 16,
                'image' => 'img/electrical3.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Премиум',
                'description' => 'Полная электрификация с защитой, автоматикой и подготовкой под "умный дом"',
                'price' => 2500,
                'sockets' => 25,
                'switches' => 15,
                'lights' => 20,
                'image' => 'img/electrical4.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('electrical')->truncate();
    }
};

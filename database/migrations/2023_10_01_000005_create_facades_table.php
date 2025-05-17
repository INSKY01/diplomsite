<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFacadesTable extends Migration
{
    public function up()
    {
        Schema::create('facades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Вставка данных
        DB::table('facades')->insert([
            ['name' => 'Натуральное дерево', 'description' => 'Фасад из натурального дерева с защитной пропиткой', 'price' => 3500, 'image' => 'img/fas1.png'],
            ['name' => 'Имитация бруса', 'description' => 'Фасад из имитации бруса с покраской', 'price' => 2800, 'image' => 'img/fas2.jpg'],
            ['name' => 'Блок-хаус', 'description' => 'Фасад из блок-хауса под бревно', 'price' => 3200, 'image' => 'img/fas3.jpg'],
            ['name' => 'Планкен', 'description' => 'Современный фасад из планкена', 'price' => 4500, 'image' => 'img/fas4.jpg'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('facades');
    }
} 
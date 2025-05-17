<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateWallFinishesTable extends Migration
{
    public function up()
    {
        Schema::create('wall_finishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Вставка данных
        DB::table('wall_finishes')->insert([
            ['name' => 'Шлифовка', 'description' => 'Шлифовка стен с защитной пропиткой', 'price' => 800, 'image' => 'img/wall1.jpg'],
            ['name' => 'Покраска', 'description' => 'Шлифовка и покраска стен', 'price' => 1200, 'image' => 'img/wall2.jpg'],
            ['name' => 'Вагонка', 'description' => 'Отделка стен вагонкой', 'price' => 2200, 'image' => 'img/wall3.jpg'],
            ['name' => 'Имитация бруса', 'description' => 'Отделка стен имитацией бруса', 'price' => 2500, 'image' => 'img/wall4.jpg'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('wall_finishes');
    }
} 
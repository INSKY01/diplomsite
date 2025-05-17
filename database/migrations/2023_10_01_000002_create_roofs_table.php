<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRoofsTable extends Migration
{
    public function up()
    {
        Schema::create('roofs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Вставка данных
        DB::table('roofs')->insert([
            ['name' => 'Двускатная', 'description' => 'Классическая двускатная крыша', 'price' => 280000, 'image' => 'img/1roof.jpg'],
            ['name' => 'Четырехскатная', 'description' => 'Традиционная четырехскатная крыша', 'price' => 350000, 'image' => 'img/2roof.jpg'],
            ['name' => 'Мансардная', 'description' => 'Крыша с жилой мансардой', 'price' => 420000, 'image' => 'img/3roof.jpg'],
            ['name' => 'Многощипцовая', 'description' => 'Сложная многощипцовая крыша', 'price' => 520000, 'image' => 'img/4roof.jpg'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roofs');
    }
} 
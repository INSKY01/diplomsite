<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateElectricalTable extends Migration
{
    public function up()
    {
        Schema::create('electrical', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('sockets');
            $table->integer('switches');
            $table->integer('lights');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Вставка данных
        DB::table('electrical')->insert([
            ['name' => 'Базовый', 'description' => 'Базовая электрика для небольшого дома', 'price' => 1200, 'sockets' => 10, 'switches' => 5, 'lights' => 8, 'image' => 'img/elec1.jpg'],
            ['name' => 'Стандарт', 'description' => 'Стандартный пакет электрики', 'price' => 1800, 'sockets' => 15, 'switches' => 8, 'lights' => 12, 'image' => 'img/elec2.jpg'],
            ['name' => 'Комфорт', 'description' => 'Расширенный пакет электрики', 'price' => 2500, 'sockets' => 20, 'switches' => 12, 'lights' => 16, 'image' => 'img/elec3.jpg'],
            ['name' => 'Премиум', 'description' => 'Премиальный пакет с системой умный дом', 'price' => 3500, 'sockets' => 25, 'switches' => 15, 'lights' => 20, 'image' => 'img/elec4.jpg'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('electrical');
    }
} 
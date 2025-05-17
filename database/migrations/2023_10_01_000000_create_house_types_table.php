<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHouseTypesTable extends Migration
{
    public function up()
    {
        Schema::create('house_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Вставка данных
        DB::table('house_types')->insert([
            ['name' => 'Каркасный дом', 'description' => 'Современный деревянный каркасный дом с отличной теплоизоляцией', 'price' => 25000, 'image' => 'img/carc-house.png'],
            ['name' => 'Дом из бруса', 'description' => 'Классический дом из строганного бруса', 'price' => 30000, 'image' => 'img/brus-house.png'],
            ['name' => 'Дом из бревна', 'description' => 'Традиционный дом из оцилиндрованного бревна', 'price' => 35000, 'image' => 'img/brev-house.jpg'],
            ['name' => 'Дом из лафета', 'description' => 'Премиальный дом из лафета ручной рубки', 'price' => 40000, 'image' => 'img/lafet-house.jpg'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('house_types');
    }
} 
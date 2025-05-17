<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFoundationsTable extends Migration
{
    public function up()
    {
        Schema::create('foundations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Вставка данных
        DB::table('foundations')->insert([
            ['name' => 'Ленточный', 'description' => 'Классический ленточный фундамент', 'price' => 12000, 'image' => 'img/fund1.jpg'],
            ['name' => 'Свайно-винтовой', 'description' => 'Современный свайно-винтовой фундамент', 'price' => 8000, 'image' => 'img/fund2.jpg'],
            ['name' => 'Свайно-ростверковый', 'description' => 'Надежный свайно-ростверковый фундамент', 'price' => 15000, 'image' => 'img/fund3.jpg'],
            ['name' => 'Монолитная плита', 'description' => 'Усиленная монолитная плита', 'price' => 18000, 'image' => 'img/fund4.jpeg'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('foundations');
    }
} 
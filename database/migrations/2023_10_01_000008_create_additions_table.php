<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAdditionsTable extends Migration
{
    public function up()
    {
        Schema::create('additions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Вставка данных
        DB::table('additions')->insert([
            ['name' => 'Терраса', 'description' => 'Открытая терраса из дерева', 'price' => 15000, 'category' => 'design', 'image' => 'img/add1.jpg'],
            ['name' => 'Крыльцо', 'description' => 'Деревянное крыльцо с навесом', 'price' => 8000, 'category' => 'design', 'image' => 'img/add2.jpg'],
            ['name' => 'Балкон', 'description' => 'Деревянный балкон с резными элементами', 'price' => 12000, 'category' => 'design', 'image' => 'img/add3.jpg'],
            ['name' => 'Веранда', 'description' => 'Закрытая веранда с панорамными окнами', 'price' => 20000, 'category' => 'design', 'image' => 'img/add4.jpg'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('additions');
    }
} 
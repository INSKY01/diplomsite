<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMaterialsTable extends Migration
{
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Вставка данных
        DB::table('materials')->insert([
            ['name' => 'Профилированный брус', 'description' => 'Сухой профилированный брус 145х145', 'price' => 28000, 'image' => 'img/prof-brus.png'],
            ['name' => 'Клееный брус', 'description' => 'Премиальный клееный брус 200х200', 'price' => 42000, 'image' => 'img/kleenyj-brus.jpg'],
            ['name' => 'Оцилиндрованное бревно', 'description' => 'Оцилиндрованное бревно диаметром 240мм', 'price' => 32000, 'image' => 'img/ocil-brus.jpg'],
            ['name' => 'Лафет', 'description' => 'Лафет ручной рубки 240х240', 'price' => 45000, 'image' => 'img/lafet-brus.png'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('materials');
    }
} 
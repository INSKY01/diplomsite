<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Таблица этажей
        if (!Schema::hasTable('floors')) {
            Schema::create('floors', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('multiplier', 8, 2);
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }

        // Таблица крыш
        if (!Schema::hasTable('roofs')) {
            Schema::create('roofs', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }

        // Таблица материалов
        if (!Schema::hasTable('materials')) {
            Schema::create('materials', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }

        // Таблица фундаментов
        if (!Schema::hasTable('foundations')) {
            Schema::create('foundations', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }

        // Таблица фасадов
        if (!Schema::hasTable('facades')) {
            Schema::create('facades', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }

        // Таблица электрики
        if (!Schema::hasTable('electricals')) {
            Schema::create('electricals', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }

        // Таблица отделки стен
        if (!Schema::hasTable('wall_finishes')) {
            Schema::create('wall_finishes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }

        // Таблица дополнений
        if (!Schema::hasTable('additions')) {
            Schema::create('additions', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->string('category');
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('floors');
        Schema::dropIfExists('roofs');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('foundations');
        Schema::dropIfExists('facades');
        Schema::dropIfExists('electricals');
        Schema::dropIfExists('wall_finishes');
        Schema::dropIfExists('additions');
    }
}; 
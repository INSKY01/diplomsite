<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('house_type_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_type_id');
            $table->unsignedBigInteger('material_id');
            $table->timestamps();

            $table->foreign('house_type_id')->references('id')->on('house_types')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            
            // Уникальный индекс для предотвращения дублирования
            $table->unique(['house_type_id', 'material_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_type_material');
    }
};

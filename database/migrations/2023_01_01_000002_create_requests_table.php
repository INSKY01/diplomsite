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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_type_id');
            $table->float('area');
            $table->unsignedBigInteger('floor_id');
            $table->unsignedBigInteger('roof_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('foundation_id');
            $table->unsignedBigInteger('facade_id');
            $table->unsignedBigInteger('electrical_id');
            $table->unsignedBigInteger('wall_finish_id');
            $table->json('additions')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('comment')->nullable();
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['new', 'in_progress', 'completed', 'cancelled'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
}; 
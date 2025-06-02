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
        Schema::table('electricals', function (Blueprint $table) {
            $table->integer('sockets')->default(0)->after('price');
            $table->integer('switches')->default(0)->after('sockets');
            $table->integer('lights')->default(0)->after('switches');
        });

        Schema::table('additions', function (Blueprint $table) {
            $table->boolean('perMeter')->default(false)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('electricals', function (Blueprint $table) {
            $table->dropColumn(['sockets', 'switches', 'lights']);
        });

        Schema::table('additions', function (Blueprint $table) {
            $table->dropColumn('perMeter');
        });
    }
};

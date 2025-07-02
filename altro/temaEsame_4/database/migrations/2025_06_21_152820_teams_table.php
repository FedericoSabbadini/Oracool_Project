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
        Schema::create('teams', function (Blueprint $table) {
            $table->string('nome')->primary();
            $table->integer('partiteGiocate')->default(0);
            $table->integer('partiteVinte')->default(0);
            $table->integer('partitePareggiate')->default(0);
            $table->integer('partitePerse')->default(0);
            $table->integer('punteggio')->default(0);
            
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};

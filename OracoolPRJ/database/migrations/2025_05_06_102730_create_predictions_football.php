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
        Schema::create('predictions_football', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->primary('id');            
            
            $table->boolean('predicted_1')->default(false);  // Punteggio previsto per la squadra di casa
            $table->boolean('predicted_X')->default(false);  // Punteggio previsto per il pari
            $table->boolean('predicted_2')->default(false);  // Punteggio previsto per la squadra in trasferta
            
        });

        Schema::table('predictions_football', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('predictions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions_football');
    }
};

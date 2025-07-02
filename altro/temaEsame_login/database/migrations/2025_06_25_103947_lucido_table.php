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
        Schema::create('lucidos', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->string('commento')->nullable();
            $table->string('percorso');
            $table->boolean('isVisible')->default(true);
            $table->timestamps();
        });

        // Optionally, you can add a seeder to populate the table with initial data
        // \App\Models\Lucido::factory()->count(10)->create();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucidos');
    }
};

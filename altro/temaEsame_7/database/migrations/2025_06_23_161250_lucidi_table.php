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
        Schema::create('lucidi', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->string('link')->nullable();
            $table->text('commento')->nullable();
            $table->boolean('isVisible')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucidi');
    }
};

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
        Schema::create('articolo_autore', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('autore_id')->unsigned();
            $table->bigInteger('articolo_id')->unsigned();
        });
        Schema::table('articolo_autore', function (Blueprint $table) {
            $table->foreign('autore_id')->references('id')->on('autori')->onDelete('cascade');
            $table->foreign('articolo_id')->references('id')->on('articoli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articolo_autore');
    }
};

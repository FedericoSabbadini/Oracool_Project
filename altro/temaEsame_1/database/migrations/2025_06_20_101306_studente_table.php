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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->date('dataAppello');
            $table->unsignedBigInteger('numMatricola');
            $table->string('cognome');
            $table->string('nome');
            $table->integer('voto')->nullable(); //-1, 18-30, 33
            $table->timestamps();

            $table->unique(['numMatricola', 'dataAppello']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

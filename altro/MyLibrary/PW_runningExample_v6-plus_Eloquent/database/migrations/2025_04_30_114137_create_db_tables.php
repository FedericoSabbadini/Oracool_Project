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
        Schema::create('author', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->timestamps();
        });

        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->timestamps();
        });

        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('street_and_number');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('postcode');
            $table->unsignedBigInteger('author_id');
            $table->timestamps();
        });

        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('book_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
        });

        Schema::table('book', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('author');
        });

        Schema::table('address', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('author');
        });

        Schema::table('book_category', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('book');
        });

        Schema::table('book_category', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_category');
        Schema::dropIfExists('book');
        Schema::dropIfExists('category');
        Schema::dropIfExists(table: 'address');
        Schema::dropIfExists('author');
    }
};

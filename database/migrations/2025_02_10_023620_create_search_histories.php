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
        // Schema::create('search_histories', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        //     $table->string('user_id');
        //     $table->string('search_query')->nullable();
        //     $table->string('genre_filter')->nullable();
        //     $table->string('minscore_filter')->nullable();
        //     $table->string('maxscore_filter')->nullable();
        //     $table->string('type_filter')->nullable();
        //     $table->string('rating_filter')->nullable();
        //     $table->string('year_filter')->nullable();
        // });
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('search_query')->nullable();
            $table->string('genre_filter')->nullable();
            $table->string('minscore_filter')->nullable();
            $table->string('maxscore_filter')->nullable();
            $table->string('type_filter')->nullable();
            $table->string('rating_filter')->nullable();
            $table->string('year_filter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_histories');
    }
};

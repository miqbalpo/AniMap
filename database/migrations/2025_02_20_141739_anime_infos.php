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
        //
        Schema::create('anime_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('mal_id')->unique();
            $table->string('anime_title')->nullable();
            $table->string('thumbnail')->nullable();
            $table->float('score')->nullable();
            $table->string('premiered')->nullable();
            $table->string('type')->nullable();
            $table->integer('episodes')->nullable();
            $table->string('status')->nullable();
            $table->string('aired')->nullable();
            $table->string('broadcast')->nullable();
            $table->string('source')->nullable();
            $table->string('duration')->nullable();
            $table->string('rating')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('studios')->nullable();
            $table->string('producers')->nullable();
            $table->string('licensors')->nullable();
            $table->string('genres')->nullable();
            $table->string('themes')->nullable();
            $table->string('demographics')->nullable();
            $table->jsonb('charactersData')->nullable(); // Ensure this is jsonb
            $table->jsonb('staffData')->nullable(); // Ensure this is jsonb
            $table->text('songs')->nullable();
            $table->string('trailer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('anime_infos');
    }
};

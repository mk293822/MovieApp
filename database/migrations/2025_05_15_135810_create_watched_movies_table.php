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
        Schema::create('watched_movies', function (Blueprint $table) {
            $table->id();
            $table->uuid('movie_id');
            $table->foreign('movie_id')
                ->references('id')->on('movies')
                ->onDelete('cascade');

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('watched_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watched_movies');
    }
};

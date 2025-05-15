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
        Schema::create('movie_user_ratings', function (Blueprint $table) {
            $table->id();
            $table->uuid('movie_id');
            $table->foreign('movie_id')
                ->references('id')->on('movies')
                ->onDelete('cascade');

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('rate', 3, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_user_ratings');
    }
};

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
        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('file_path');          // e.g., "movies/movie123.mp4"
            $table->string('mime_type');          // e.g., "video/mp4"
            $table->bigInteger('file_size');      // in bytes
            $table->integer('duration')->nullable();     // in seconds
            $table->string('resolution')->nullable();    // e.g., "1920x1080"
            $table->boolean('is_public')->default(false); // for access control

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};

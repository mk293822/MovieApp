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
            $table->string('file_path');
            $table->string('mime_type');
            $table->bigInteger('file_size');
            $table->integer('duration')->nullable();
            $table->string('resolution')->nullable();
            $table->string('codec')->nullable();         // Added codec field
            $table->string('bitrate')->nullable();       // Added bitrate field
            $table->string('frame_rate')->nullable();    // Added frame rate field
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

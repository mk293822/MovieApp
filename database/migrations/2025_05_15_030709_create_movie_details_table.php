<?php

use App\Enums\MovieGenreEnums;
use App\Enums\MovieLanguageEnums;
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
        Schema::create('movie_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('movie_id');
            $table->foreign('movie_id')
                ->references('id')->on('movies')
                ->onDelete('cascade');

            $table->string('title')->index();
            $table->text('description')->nullable();
            $table->enum('genre', array_map(fn($genre) => $genre->value, MovieGenreEnums::cases()))->default(MovieGenreEnums::NotSpecified->value)->index();
            $table->year('release_year')->nullable();
            $table->enum('language', array_map(fn($language) => $language->value, MovieLanguageEnums::cases()))
                ->default(MovieLanguageEnums::NotSpecified->value)
                ->nullable()->index();
            $table->string('director')->nullable()->index();
            $table->string('poster_path')->nullable();
            $table->decimal('rating', 3, 1)->nullable()->index();
            $table->bigInteger('views')->default(0);
            $table->boolean('is_public')->default(false); // for access control
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_details');
    }
};

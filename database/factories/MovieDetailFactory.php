<?php

namespace Database\Factories;

use App\Enums\MovieGenreEnums;
use App\Enums\MovieLanguageEnums;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posterName = Str::uuid() . '.jpg';
        $coverName = Str::uuid() . '.jpg';
        $posterPath = "posters/{$posterName}";
        $coverPath = "video_covers/{$coverName}";

        file_put_contents(Storage::disk('public')->path($posterPath), $this->faker->image(null, 300, 450, 'movies', false));
        file_put_contents(Storage::disk('public')->path($coverPath), $this->faker->image(null, 1280, 720, 'movies', false));

        return [
            'title'        => $this->faker->sentence(3),
            'description'  => $this->faker->paragraph(3),
            'genre'        => $this->faker->randomElement(MovieGenreEnums::cases()),
            'release_year' => $this->faker->year(),
            'language'     => $this->faker->randomElement(MovieLanguageEnums::cases()),
            'director'     => $this->faker->name(),
            'poster_path'  => $posterPath,
            'cover_path'   => $coverPath,
            'rating'       => $this->faker->randomFloat(1, 1, 10),
            'views'        => $this->faker->numberBetween(0, 1_000_000),
            'is_public'    => $this->faker->boolean(90),
        ];
    }
}

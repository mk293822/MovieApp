<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $resolutions = [
            [1280, 720],     // HD
            [1920, 1080],    // Full HD
            [2560, 1440],    // QHD
            [3840, 2160],    // 4K
        ];

        [$width, $height] = $this->faker->randomElement($resolutions);

        $filename = $this->faker->unique()->slug . '.mp4';
        $relativePath = "videos/{$filename}";
        $fullPath = Storage::disk('public')->path($relativePath);

        // Simulate a fake video file (optional, for real dev testing)
        if (!file_exists($fullPath)) {
            file_put_contents($fullPath, str_repeat('0', 1024 * 1024)); // create 1MB dummy file
        }

        $size = filesize($fullPath); // actual file size in bytes

        return [
            'file_path'   => $relativePath, // relative path within the 'public' disk
            'mime_type'   => 'video/mp4',
            'file_size'   => $size, // actual size from file
            'duration'    => $this->faker->numberBetween(3600, 10800), // 1–3 hours
            'resolution'  => "{$width}x{$height}",
            'codec'       => $this->faker->randomElement(['H.264', 'H.265', 'VP9']),
            'bitrate'     => $this->faker->numberBetween(2_000_000, 8_000_000), // realistic bitrates
            'frame_rate'  => $this->faker->randomElement([23.97, 24, 25, 29.97, 30, 60]),
        ];
    }
}

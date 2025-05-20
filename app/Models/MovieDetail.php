<?php

namespace App\Models;

use App\Enums\MovieGenreEnums;
use App\Enums\MovieLanguageEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property-read \App\Models\Movie|null $movie
 * @method static \Database\Factories\MovieDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail query()
 * @mixin \Eloquent
 */
class MovieDetail extends Model
{
    /** @use HasFactory<\Database\Factories\MovieDetailFactory> */

    use HasFactory;

    protected $fillable = [
        'movie_id',
        'title',
        'description',
        'genre',
        'release_year',
        'language',
        'director',
        'poster_path',
        'rating',
        'views',
        'is_public',
        'cover_path',
    ];

    protected $casts = [
        'genre' => MovieGenreEnums::class,
        'language' => MovieLanguageEnums::class,
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}

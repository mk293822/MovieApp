<?php

namespace App\Models;

use App\Enums\CategorieEnums;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

/**
 *
 *
 * @property-read \App\Models\MovieDetail|null $details
 * @method static \Database\Factories\MovieFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie query()
 * @mixin \Eloquent
 */
class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasUuids, HasFactory, Searchable;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'file_path',
        'mime_type',
        'file_size',
        'duration',
        'resolution',
        'codec',
        'bitrate',
        'frame_rate',
    ];

    public function details()
    {
        return $this->hasOne(MovieDetail::class);
    }

    public function searchable()
    {
        return $this->with('details');
    }

    public function toSearchableArray()
    {
        $details = $this->details;

        return [
            'id' => $this->id,
            'title' => $details->title ?? '',
            'description' => $details->description ?? '',
            'genre' => $details->genre->value ?? '',
            'language' => $details->language->value ?? '',
            'director' => $details->director ?? '',
        ];
    }

    public function getFilePathAttribute()
    {
        return Storage::url($this->attributes['file_path']);
    }

    public function scopeForIsPublic($query)
    {
        return $query->whereHas('details', function ($query) {
            $query->where('is_public', true);
        });
    }

    public function getPosterPathAttribute()
    {
        return Storage::url($this->details?->poster_path);
    }

    public function getCoverPathAttribute()
    {
        return Storage::url($this->details?->cover_path);
    }

    public function getIsPublicAttribute()
    {
        return $this->details?->is_public;
    }

    public function scopeForCategories($query, CategorieEnums $category)
    {
        if ($category === CategorieEnums::NowShowing) {
            return $query->whereHas('details', function ($q) {
                $q->where('release_year', '>=', now()->year);
            })->select('movies.*')
                ->with('details')
                ->join('movie_details', 'movies.id', '=', 'movie_details.movie_id')
                ->orderByDesc("movie_details.created_at");
        }

        return $query->whereHas('details')
            ->select('movies.*')
            ->with('details')
            ->join('movie_details', 'movies.id', '=', 'movie_details.movie_id')
            ->orderByDesc("movie_details.{$category->value}");
    }

    public function scopeForRelatedMovies($query, $movie)
    {

        $user = Auth::user();

        $excludedIds = collect([
            $movie->id,
            ...$user->watchedMovies()->pluck('movie_id')->toArray(),
            ...$user->savedMovies()->pluck('movie_id')->toArray(),
        ])->unique();

        return $query->whereNotIn('id', $excludedIds)
            ->whereHas('details', function ($q) use ($movie) {
                $q->where('genre', $movie->details->genre)
                    ->orWhere('director', $movie->details->director);
            });
    }

    public function usersWhoSaved()
    {
        return $this->belongsToMany(User::class, 'saved_movies')->withPivot('saved_at');
    }

    public function usersWhoWatched()
    {
        return $this->belongsToMany(User::class, 'watched_movies')->withPivot('watched_at');
    }
}

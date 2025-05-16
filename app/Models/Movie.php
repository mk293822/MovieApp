<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

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
    use HasUuid;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'file_path',
        'mime_type',
        'file_size',
        'duration',
        'resolution',
    ];

    public function details()
    {
        return $this->hasOne(MovieDetail::class);
    }

    public function scopeForIsPublic($query)
    {
        return $query->whereHas('movie_details', function ($query) {
            $query->where('is_public', true);
        });
    }

    public function getIsPublicAttribute()
    {
        $this->details?->is_public;
    }

    public function raters()
    {
        return $this->belongsToMany(User::class, 'movie_user_ratings')
                    ->withPivot('rate')
                    ->withTimestamps();
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

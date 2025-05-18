<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    use HasUuids, HasFactory;

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

    public function getFilePathAttribute()
    {
        return Storage::url($this->attributes['file_path']);
    }

    public function details()
    {
        return $this->hasOne(MovieDetail::class);
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

    public function usersWhoSaved()
    {
        return $this->belongsToMany(User::class, 'saved_movies')->withPivot('saved_at');
    }

    public function usersWhoWatched()
    {
        return $this->belongsToMany(User::class, 'watched_movies')->withPivot('watched_at');
    }
}

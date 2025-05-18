<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\MovieDetail|null $details
 * @method static \Database\Factories\MovieFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie query()
 * @mixin \Eloquent
 * @property string $id
 * @property string $file_path
 * @property string $mime_type
 * @property int $file_size
 * @property int|null $duration
 * @property string|null $resolution
 * @property string|null $codec
 * @property string|null $bitrate
 * @property string|null $frame_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $cover_path
 * @property-read mixed $is_public
 * @property-read mixed $poster_path
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usersWhoSaved
 * @property-read int|null $users_who_saved_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usersWhoWatched
 * @property-read int|null $users_who_watched_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie forIsPublic()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereBitrate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereCodec($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereFrameRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereResolution($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereUpdatedAt($value)
 */
	class Movie extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Movie|null $movie
 * @method static \Database\Factories\MovieDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $movie_id
 * @property string $title
 * @property string|null $description
 * @property \App\Enums\MovieGenreEnums|null $genre
 * @property int|null $release_year
 * @property \App\Enums\MovieLanguageEnums|null $language
 * @property string|null $director
 * @property string|null $poster_path
 * @property string|null $cover_path
 * @property string|null $actors
 * @property string|null $rating
 * @property int $views
 * @property int $is_public
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereActors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereCoverPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail wherePosterPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereReleaseYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail whereViews($value)
 */
	class MovieDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserDetails|null $details
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $is_banned
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movie> $savedMovies
 * @property-read int|null $saved_movies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movie> $watchedMovies
 * @property-read int|null $watched_movies_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $liked_movies
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserDetailsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereLikedMovies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $full_name
 * @property string|null $avatar
 * @property int $is_banned
 * @property \App\Enums\RoleEnums $role
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereIsBanned($value)
 */
	class UserDetails extends \Eloquent {}
}

